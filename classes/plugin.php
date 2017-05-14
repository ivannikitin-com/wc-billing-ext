<?php
/**
 * Класс реализует основной функционал плагина
 */
namespace WCBE;
class Plugin
{
	/**
	 * Путь к файлам плагина
	 * @var string
	 */
	public $path;
	/**
	 * URL к файлам плагина
	 * @var string
	 */
	public $url;
		
	/**
	 * Конструктор
	 * Инициализация плагина
	 */
	public function __construct( $pluginPath, $pluginURL )
	{
		$this->path = $pluginPath;	// Путь к файлам плагина
		$this->url = $pluginURL;	// URL к файлам плагина
		
		// Хуки
		add_filter('woocommerce_customer_meta_fields', array( $this, 'get_customer_meta_fields' ) );
		add_filter('woocommerce_admin_billing_fields', array( $this, 'woocommerce_admin_billing_fields' ) );
	}
	
	/**
	 * Формирует массив данных для добавления
	 */
	private function get_extra_meta_fields()
	{
		return array(
			'inn' => array(
				'label'       => __( 'INN', WCBE ),
				'description' => 'Customer INN (Russian Federation)',
				'show' => false,
				'class' => 'form-row-left',
			),
			'kpp' => array(
				'label'       => __( 'KPP', WCBE ),
				'description' => 'Customer KPP (Russian Federation)',
				'show' => false,
				'class' => 'form-row-right',
			),			
			'ogrn' => array(
				'label'       => __( 'OGRN', WCBE ),
				'description' => 'Customer OGRN (Russian Federation)',
				'show' => false,
				'class' => 'form-row-left',
			),
			'account' => array(
				'label'       => __( 'Bank Account', WCBE ),
				'description' => 'Customer Bank Account',
				'show' => false,
				'class' => 'form-row-right',
			),
			'bank' => array(
				'label'       => __( 'Bank', WCBE ),
				'description' => 'Customer Bank',
				'show' => false,
				'class' => 'form-row-left',
			),				
			'bic' => array(
				'label'       => __( 'Bank ID Code', WCBE ),
				'description' => 'Customer Bank BIC or SWIFT',
				'show' => false,
				'class' => 'form-row-right',
			),			
		);		
	}		

	/**
	 * Возвращает расширенный массив пользовательских данных
	 * Вызывается фильтром woocommerce_customer_meta_fields
	 * https://github.com/woocommerce/woocommerce/blob/795e6871c037ca9b9519dd59436f43712486bd1d/includes/admin/class-wc-admin-profile.php
	 *
	 * @param mixed meta_fields	Массив данных пользователя
	 */
	public function get_customer_meta_fields( $meta_fields )
	{

		$extra_fields = $this->get_extra_meta_fields();
		$meta_fields['billing']['fields'] = array_merge( $meta_fields['billing']['fields'], $extra_fields );
		return $meta_fields;
	}	

	/**
	 * Возвращает расширенный массив пользовательских данных
	 * Вызывается фильтром woocommerce_admin_billing_fields
	 * https://github.com/woocommerce/woocommerce/blob/f6136ba3264742a21b8b1fdf8fc2060b77323ea6/includes/admin/meta-boxes/class-wc-meta-box-order-data.php
	 *
	 * @param mixed meta_fields	Массив данных пользователя
	 */
	public function woocommerce_admin_billing_fields( $meta_fields )
	{

		$extra_fields = $this->get_extra_meta_fields();
		$meta_fields = array_merge( $meta_fields, $extra_fields );
		return $meta_fields;
	}	
}