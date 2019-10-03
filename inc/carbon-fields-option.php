<?php
	
	use Carbon_Fields\Container;
	use Carbon_Fields\Field;
	
	add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
	function crb_attach_theme_options() {

		$basic_options_container = Container::make( 'theme_options', __( 'Theme Options' ) )

			->add_tab('Общее', array(
				Field::make( 'text', 'general_email', 'Почта' )->set_default_value('info@wimp.com'),
				Field::make( 'image', 'general_logo_login', 'Логотип при входе в даминку' )
					->set_value_type( 'url' )
			))
				
			/**
			 * Order recevied
			 */
			->add_tab( __( 'Заказ принят' ), array(
				Field::make( 'rich_text', 'body_thankyou_page_1', 'Заголовок' ),
				Field::make( 'rich_text', 'body_thankyou_page_2', 'Контент' ),
			) )

			/**
			 * 404 page
			 */
			->add_tab( __( '404' ), array(
				// Field::make( 'text', 'title_404_page', 'Название вкладки' )->set_default_value('Страница не найдена'),
				Field::make( 'rich_text', 'body_404_page', 'Контент' ),
			) )
			
			/**
			 * Maintenance
			 */
			->add_tab( __( 'Maintenance' ), array(
				Field::make( 'text', 'title_maintenance_page', 'Название вкладки' )->set_default_value('Техническое обслуживание'),
				Field::make( 'rich_text', 'body_maintenance_page', 'Контент' ),
			) )

			/**
			 * Footer
			 */
			->add_tab( 'Подвал', array(

				Field::make('separator', 'separator_footer_col_1', 'Первая колонка'),
				
				Field::make( 'textarea', 'footer_copyright', 'Текст "Все права защищены"' )
					->set_width(75),
				Field::make( 'image', 'footer_logo', 'Логотип в подвале' )
					->set_value_type( 'url' )
					->set_width(25),
					
				Field::make('separator', 'separator_footer_col_2', 'Колонка "Категории"'),
				Field::make( 'text', 'footer_col_2_title', 'Заголовок' )
					->set_default_value('Категории'),
				
				Field::make('separator', 'separator_footer_col_4', 'Колонка "Соц. сети"'),

				Field::make( 'complex', 'crb_slides', 'Список соц. сетей' )->add_fields( array(
					Field::make( 'image', 'footer_complex_social_image', 'Изображение соц. сети' )
						->set_value_type( 'url' )
						->set_width(25),
					Field::make( 'text', 'footer_complex_social_link', 'Ссылка на соц.сети' )->set_width(75)
				))->set_layout('tabbed-horizontal'),

				Field::make('separator', 'separator_footer_col_5', 'Колонка "Способы оплаты"'),

				Field::make( 'complex', 'footer_complex_payment', 'Галерея способов оплаты' )->add_fields( array(
					Field::make( 'image', 'footer_complex_payment_image', 'Изображение' )
						->set_value_type( 'url' )
						->set_width(25),
				))->set_layout('tabbed-horizontal'),

				Field::make('text', 'separator_footer_year', 'Нижняя граница в подвале')
					->set_default_value('© 2019 Wimp'),

		));

		// Add second options page under 'Basic Options'
		Container::make( 'theme_options', 'Other' )
		->set_page_parent( $basic_options_container ) // reference to a top level container
		->add_fields( array(

			Field::make('separator', 'separator_footer_col_3', 'Колонка "Информация"'),

			Field::make( 'text', 'footer_col_3_title', 'Заголовок' )
				->set_default_value('Информация'),
				
			Field::make( 'association', 'footer_list_pages', 'Подвал. Список страниц' )
			->set_types( array(
				array(
					'type' => 'post',
					'post_type' => 'page',
				),
			)),
		) );

	}
	
?>