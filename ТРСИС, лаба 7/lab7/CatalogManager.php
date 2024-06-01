<?php

namespace lab7;


// 15. Пройти по дереву каталогов, начиная с текущего, и удалить все
// файлы на языке Си, содержащие внутри максимальное количество
// операторов if-else не менее 2, и имеющие шаблон имени файла: в названии
// файла имеются две точки и дата в виде YYMMDD в любом месте и младше
// месяца и старше недели с правами только на чтение.

use DateTime;

class CatalogManager
{

    private $files_needs_to_be_deleted = [];
    private $temp_files = [];

    public function index()
    {
        header("Location: ./views/index.php");
        die();
    }

    private function deleteFiles($dir)
    {
        $files = glob($dir.'/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            } else {
                $this->deleteFiles($file);
                rmdir($file);
            }
        }
    }

    public function generate()
    {

        $directory = dirname(__FILE__, 2).'/lab7/files/';
        $start_date = strtotime('2023-02-01');
        $end_date = strtotime(date('Y-m-d'));
        $dirs = [
          './1', './2', './3', './test', './test/1', './test/2', './test/3', './test/1/1', './test/1/2', './test/1/1/1',
          './test/1/1/2', './1/5', './abc', './abc/qwe', './abc/ewq', './test/test'
        ];

        $this->deleteFiles($directory);
        foreach ($dirs as $dir) {
            mkdir($directory.$dir);
        }

        for ($i = 1; $i <= 10000; $i++) {
            $target_file = mt_rand(1, 6);
            $random_dir = $dirs[rand(0, count($dirs) - 1)];
            $filename = $random_dir.'/file_'.(mt_rand(0, 1) < 0.5 ? '.' : '_').mt_rand(100,
                999999999).'.c';
            $filepath = $directory.$filename;
            if (mt_rand(0, 1) < 0.5) {
                $file_rights = 0444; // read-only
            } else {
                $file_rights = 0777; // all rights
            }
            $file_creation_time = mt_rand($start_date, $end_date);
            $content = file_get_contents('../examples/file'.$target_file.'.c');
            file_put_contents($filepath, $content);
            chmod($filepath, $file_rights);
            exec("touch -t ".date('YmdHi', $file_creation_time)." '$filepath'");
        }
        header("Location: ../views/index.php");
        die();
    }

    public function listFolders($dir): string
    {
        $html = "<ul>";
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                if (is_dir($dir."/".$file)) {
                    $html .= "<li>".$file;
                    $html .= $this->listFolders($dir."/".$file);
                    $html .= "</li>";
                } else {
                    $file_path = $dir."/".$file;
                    $file_info = stat($file_path);
                    $creation_date = date("Y-m-d H:i:s", $file_info['mtime']);
                    $user_abilities = decoct(fileperms($file_path) & 0777);
                    $html .= '<li><a href="'.$file_path.'">'.$file.' - '.$creation_date.', '.$user_abilities.'</a></li>';
                }
            }
        }
        $html .= "</ul>";
        return $html;
    }

    private function is_filename_valid($filename): bool
    {
        if (substr_count($filename, '.') != 2) {
            return false;
        }
        preg_match('/\d{6}/', $filename, $matches);
        if (!$matches) {
            return false;
        }
        foreach ($matches as $date_string) {
            $date_string = strval($date_string);
            $date = DateTime::createFromFormat('ymd', $date_string);
            if ($date && $date->format('ymd') === $date_string) {
                return true;
            }
        }
        return false;
    }

    private function deleteRec($dir)
    {
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                $file_path = $dir."/".$file;
                if (is_dir($file_path)) {
                    $this->deleteRec($file_path);
                } else {
                    $file_info = stat($file_path);
                    $user_abilities = decoct(fileperms($file_path) & 0777);
                    if ($user_abilities == '444') {
                        $from_creation = (time() - filemtime($file_path));
                        if ($from_creation > 24 * 60 * 60 * 7 && $from_creation < 24 * 60 * 60 * 30) {
                            if ($this->is_filename_valid($file)) {
                                $content = file_get_contents($file_path);
                                $count = substr_count($content, 'if') + substr_count($content, 'else');
                                $this->temp_files[] = [
                                  'count' => $count,
                                  'file_path' => $file_path
                                ];
                            }
                        }
                    }
                }
            }
        }

    }

    public function delete()
    {
        $this->deleteRec('../files');

        $max_count = 0;
        foreach ($this->temp_files as $file_data) {
            $max_count = max($max_count, $file_data['count']);
        }

        echo 'if-else количество: '.$max_count.'<br>';
        foreach ($this->temp_files as $file_data) {
            if ($max_count == $file_data['count'] && $max_count >= 2) {
                $this->files_needs_to_be_deleted[] = $file_data['file_path'];
            }
        }
        if (count($this->files_needs_to_be_deleted)) {
            echo "Всего найдено ".count($this->files_needs_to_be_deleted).' файлов, которые нужно удалить <br>';
            echo 'Вот они: <br><br><ul>';
            foreach ($this->files_needs_to_be_deleted as $file) {
                echo '<li><a href="'.$file.'">'.$file.'</a></li>';
            }
            echo '</ul>';
            echo '<form action="./remove.php" method="post">
                <input type="hidden" name="remove" value="'.base64_encode(json_encode($this->files_needs_to_be_deleted)).'">
                <button type="submit">Удалить файлы</button>
            </form><br>';
        } else {
            echo 'Нечего удалять. Уходите отсюда. <br>';
        }

        echo '<a href="../index.php">Назад на главную</a>';
    }

    public function remove($files)
    {
        $files_needs_to_be_deleted = json_decode(base64_decode($files));
        foreach ($files_needs_to_be_deleted as $file_path) {
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        header("Location: ../index.php");
        die();
    }


}