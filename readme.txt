== Установка/Обновление ==

<h3 style="text-align: center;">Установка:</h3>
Т.к. это дополнение для WordPress плагина <a href="https://codeseller.ru/groups/plagin-wp-recall-lichnyj-kabinet-na-wordpress/" target="_blank">WP-Recall</a>, то оно устанавливается через <a href="https://codeseller.ru/obshhie-svedeniya-o-dopolneniyax-wp-recall/" target="_blank"><strong>менеджер дополнений WP-Recall</strong></a>.

1. В админке вашего сайта перейдите на страницу "WP-Recall" -> "Дополнения" и в самом верху нажмите на кнопку "Обзор", выберите .zip архив дополнения на вашем пк и нажмите кнопку "Установить".
2. В списке загруженных дополнений, на этой странице, найдите это дополнение, наведите на него курсор мыши и нажмите кнопку "Активировать". Или выберите чекбокс и в выпадающем списке действия выберите "Активировать". Нажмите применить.


<h3 style="text-align: center;">Обновление:</h3>
Дополнение поддерживает <a href="https://codeseller.ru/avtomaticheskie-obnovleniya-dopolnenij-plagina-wp-recall/" target="_blank">автоматическое обновление</a> - два раза в день отправляются вашим сервером запросы на обновление.
Если в течении суток вы не видите обновления (а на странице дополнения вы видите что версия вышла новая), советую ознакомиться с этой <a href="https://codeseller.ru/post-group/rabota-wordpress-krona-cron-prinuditelnoe-vypolnenie-kron-zadach-dlya-wp-recall/" target="_blank">статьёй</a>




== Настройки ==
Переходим в админку: "WP-Recall" -> "Поля профиля"
Из неактивных полей переносим в нужное место поле профиля "Пол"
Нужные опции в этом поле настройте под себя.

Чтобы выставленное значение пола показывалось другим пользователям - установите опцию "отображать для других пользователей" - "Да"



== Разработчикам ==
Дополнение писалось под свои нужды - т.к. часто мне требовалось писать сообщения человечным языком:

Например: "Sunny опубликовала новую запись" - т.е. мне нужна была опция склонения по указанному полу.

Теперь есть произвольное поле "rcl_sex" и функция <code>rcl_decline_by_sex( $user_id, $data )</code>
- она позволяет склонять на основе пола. 

Первым аргументом принимает: $user_id - id пользователя, событие которого нужно склонять
Второй аргумент: $data - массив склонений. 0 ключ - значение мужского рода, 1 ключ - женского. Если у пользователя не указан пол - возьмется 0 ключ

Пример:
<pre>
    $data    = [ 'опубликовал', 'опубликовала' ];
    $decline = rcl_decline_by_sex( 1, $data );

    return 'Sunny ' . $decline . ' новую запись';
</pre>




== Changelog ==
= 2019-06-25 =
v1.0.1
* Для wp-cron задачи можно применять <code>user_id = -1</code> - тогда функция <code>rcl_decline_by_sex()</code> вернет корректное значение по дефолту.
(поддержка допа universe activity)


= 2019-06-21 =
v1.0
* Release





== Прочее ==

* Поддержка осуществляется в рамках текущего функционала дополнения
* При возникновении проблемы, создайте соотвествующую тему на форуме поддержки товара
* Если вам нужна доработка под ваши нужды - вы можете обратиться ко мне в <a href="https://codeseller.ru/author/otshelnik-fm/?tab=chat" target="_blank">ЛС</a> с техзаданием на платную доработку.

Все мои работы опубликованы <a href="https://otshelnik-fm.ru/?p=2562&utm_source=free-addons&utm_medium=addon-description&utm_campaign=woman-man&utm_content=codeseller.ru&utm_term=all-my-addons" target="_blank">на моём сайте</a> и в каталоге магазина <a href="https://codeseller.ru/author/otshelnik-fm/?tab=publics&subtab=type-products" target="_blank">CodeSeller.ru</a>
