<?php

/*

  ╔═╗╔╦╗╔═╗╔╦╗
  ║ ║ ║ ╠╣ ║║║ http://otshelnik-fm.ru
  ╚═╝ ╩ ╚  ╩ ╩

 */


if ( ! defined( 'ABSPATH' ) )
    exit;


// добавим в админку
add_filter( 'rcl_default_profile_fields', 'wmnm_field_sex_profile', 10, 2 );
function wmnm_field_sex_profile( $fields ) {

    $fields[] = array(
        'type'   => 'select',
        'slug'   => 'rcl_sex',
        'values' => [ 'Не указано', 'Мужской', 'Женский' ],
        'title'  => 'Пол'
    );

    return $fields;
}

// и немного обрежем там что не надо
add_filter( 'rcl_custom_field_options', 'wmnm_exclude_variations', 10, 3 );
function wmnm_exclude_variations( $options, $field, $post_type ) {
    // это не страница "поля профиля"
    if ( $post_type !== 'profile' )
        return $options;

    // это не наше поле
    if ( isset( $field['slug'] ) && ( $field['slug'] !== 'rcl_sex' ) )
        return $options;

    // что нам не нужно - удалим
    foreach ( $options as $option ) {
        // первое значение
        if ( $option['slug'] == 'empty-first' )
            continue;

        // добавляемые значения
        if ( $option['slug'] == 'values' )
            continue;

        // отображать для других пользователей
        //if ( $option['slug'] == 'req' )
        //    continue;
        // редактируется администрацией
        if ( $option['slug'] == 'admin' )
            continue;

        // отображать в заказе
        if ( $option['slug'] == 'order' )
            continue;

        // Макс. кол-во знаков
        if ( $option['slug'] == 'maxlength' )
            continue;

        $opt[] = $option;
    }

    return $opt;
}

// добавим в ЛК (таб профиль)
add_filter( 'rcl_profile_fields', 'wmnm_add_form', 10 );
function wmnm_add_form( $fields ) {
    foreach ( $fields as $field ) {
        if ( $field['slug'] === 'rcl_sex' ) {
            $field['values'] = [ 'Не указано', 'Мужской', 'Женский' ];
        }

        $opt[] = $field;
    }

    return $opt;
}

// склоняем
//$data = ['опубликовал','опубликовала']
function rcl_decline_by_sex( $user_id, $data ) {
    // wp-cron (universe activity)
    if ( $user_id == '-1' )
        return $data[0];

    $sex = get_user_meta( $user_id, 'rcl_sex', true );

    $out = $data[0];

    if ( $sex ) {
        $out = ($sex === 'Женский') ? $data[1] : $data[0];
    }

    return $out;
}

// пример использования
//add_action( 'init', 'otfm_sample_decline' );
function otfm_sample_decline() {
    $data    = [ 'опубликовал', 'опубликовала' ];
    $decline = rcl_decline_by_sex( 1, $data );

    //vda( 'Sunny ' . $decline . ' новую запись' );
}
