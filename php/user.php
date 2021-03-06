<?php if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_579ae865e35f0',
	'title' => 'Additional Fields',
	'fields' => array (
		array (
			'key' => 'field_579ae8958b0db',
			'label' => 'I\'m interested in...',
			'name' => 'role',
			'type' => 'checkbox',
			'instructions' => 'Check all that apply',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
        'grower' => 'Finding a garden',
       'owner' =>  'Hosting a garden',
       'farmer' => 'Helping with gleaming/farm days',
       'mentee' => 'Finding a mentor',
       'mentor' => 'Becoming a mentor',
       'sharer' => 'Sharing food I\'ve grown'
			),
			'default_value' => array (
			),
			'layout' => 'vertical',
			'toggle' => 0,
		),
		array (
			'key' => 'field_57bd0320278f3',
			'label' => 'Neighborhood',
			'name' => 'neighborhood',
			'type' => 'select',
			'instructions' => 'Our boundaries are the ones used by the Neighborhood Board system.	If you\'re not sure where you fit, check the maps here: http://www.honolulu.gov/cms-nco-menu/site-nco-sitearticles/446-boundary-maps.html',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'none' => '-- Neighborhood --',
				'Hawaii Kai' => 'Hawaii Kai',
				'Kuliouou-Kalani Iki' => 'Kuliouou-Kalani Iki',
				'Waialae-Kahala' => 'Waialae-Kahala',
				'Kaimuki' => 'Kaimuki',
				'Diam. Head/Kapahulu/St. Louis' => 'Diam. Head/Kapahulu/St. Louis',
				'Palolo' => 'Palolo',
				'Manoa' => 'Manoa',
				'McCully-Moiliili' => 'McCully-Moiliili',
				'Waikiki' => 'Waikiki',
				'Makiki-Tantalus' => 'Makiki-Tantalus',
				'Ala Moana-Kakaako' => 'Ala Moana-Kakaako',
				'Nuuanu-Punchbowl' => 'Nuuanu-Punchbowl',
				'Downtown' => 'Downtown',
				'Liliha/Puunui/Alewa' => 'Liliha/Puunui/Alewa',
				'Kalihi-Palama' => 'Kalihi-Palama',
				'Kalihi Valley' => 'Kalihi Valley',
				'Aliamanu-Salt Lake' => 'Aliamanu-Salt Lake',
				'Aiea' => 'Aiea',
				'Pearl City' => 'Pearl City',
				'Waipahu' => 'Waipahu',
				'Ewa' => 'Ewa',
				'Waianae Coast' => 'Waianae Coast',
				'Mililani-Waipio' => 'Mililani-Waipio',
				'Wahiawa-Whitmore Village' => 'Wahiawa-Whitmore Village',
				'North Shore' => 'North Shore',
				'Koolauloa' => 'Koolauloa',
				'Kahaluu' => 'Kahaluu',
				'Kaneohe' => 'Kaneohe',
				'Kailua' => 'Kailua',
				'Waimanalo' => 'Waimanalo',
				'Makakilo/Kapolei/Honokai Hale' => 'Makakilo/Kapolei/Honokai Hale',
				'Mililani Mauka/Launani Valley' => 'Mililani Mauka/Launani Valley',
				'Nanakuli-Maili' => 'Nanakuli-Maili',
			),
			'default_value' => array (
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,
		),
		array (
			'key' => 'field_57a181a859c7b',
			'label' => 'Skills',
			'name' => 'skills',
			'type' => 'text',
			'instructions' => 'List skills that you are proficient in so other gardenhui members can connect with you!',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'gardening, mulching, composting...',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_57a181c059c7d',
			'label' => 'Resources',
			'name' => 'resources',
			'type' => 'text',
			'instructions' => 'List any tools or resources that you have access to.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'garden hoes, gloves, etc...',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
    array (
      'key' => 'field_57a181c059c7e',
      'label' => 'Things I\'d like to share with my Hui',
      'name' => 'sharing',
      'type' => 'text',
      'instructions' => 'What do you want to share with your hui?',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => 'Food, tools, love, etc...',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
      'readonly' => 0,
      'disabled' => 0,
    ),
		array (
			'key' => 'field_57b7f1dc26408',
			'label' => 'Show my real name on public pages',
			'name' => 'private_profile',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'user_role',
				'operator' => '==',
				'value' => 'all',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array (
		0 => 'permalink',
		1 => 'the_content',
		2 => 'excerpt',
		3 => 'custom_fields',
		4 => 'discussion',
		5 => 'comments',
		6 => 'revisions',
		7 => 'slug',
		8 => 'author',
		9 => 'format',
		10 => 'page_attributes',
		11 => 'featured_image',
		12 => 'categories',
		13 => 'tags',
		14 => 'send-trackbacks',
	),
	'active' => 1,
	'description' => '',
));

endif; ?>
