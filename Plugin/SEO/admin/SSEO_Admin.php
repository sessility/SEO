<?php
class SSEO_Admin extends SSEO_Base
{

    private $capability;

    public function SSEO_Admin($capability = 'edit_posts') {

        $this->capability = $capability;

        $this->setup();

    }

    public function setup()
    {
        add_action('admin_menu', array(&$this, 'create_dashboard_menu'));

    }

    public function create_dashboard_menu()
    {
        add_menu_page( $this->get_name(), $this->get_name(), $this->capability, $this->get_slug(), $this->get_admin_index());
    }

    private function get_admin_index()
    {
        return 'foo';
    }

}
?>
