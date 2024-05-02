# additional-available-and-user-interface.py - Модуль дополнительных возможностей и пользовательского интерфейса

# Импорт необходимых модулей
import lighting_system
import animation_editor
import save_load_system
import extensions_module

# Функция для добавления дополнительных возможностей и настройки пользовательского интерфейса
def add_additional_features():
    # Добавление системы освещения
    lighting_system.add_lighting()
    
    # Запуск редактора анимаций
    animation_editor.launch_editor()
    
    # Настройка системы сохранения и загрузки
    save_load_system.setup_save_load()
    
    # Подключение модуля расширений
    extensions_module.connect_extensions()

# Добавление дополнительных возможностей и настройка пользовательского интерфейса
add_additional_features()
