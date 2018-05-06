<?php
class Practice_Plugin {
    public function __construct(string $string) {
        add_action('init', array($this, 'custom_post_type'));
        add_action('wp_enqueue_scripts', array($this, 'style'));
        add_shortcode('practice_plugin', array($this, 'shortcode'));
        // add action to make $this->custom_post_type() work
    }

    public function activate() {
        $this->custom_post_type();
        flush_rewrite_rules();
    }

    public function deactivate() {

    }

    public function uninstall() {

    }

    public function style() {
        wp_enqueue_style( 'plugin-practice-style',  PRACTICE_PLUGIN_URL. "/assets/css/style.css");
        wp_enqueue_script('jquery');
        wp_enqueue_script( 'plugin-practice-script',  PRACTICE_PLUGIN_URL . "/assets/js/script.js", array('jquery'));
    }

    public function shortcode() {
        $output = '
        <form class="conversionForm">
        <section class="conversionForm__currencies">
            <div class="conversionForm__from">
                <label>From:</label>
                <select class="convertFrom">
                  <option selected="selected">BTC</option>
                  <option>ETH</option>
                  <option>LTC</option>
                </select>
            </div>
            <div class="conversionForm__to">
                <label>To:</label>
                <select class="convertTo">
                  <option selected="selected">USD</option>
                  <option>EUR</option>
                  <option>GBP</option>
                </select>
            </div>
        </section>
        <section class="conversionForm__amount">
            <input type="number" min="0" value="1" class="currencyValue" id="input">
            <input type="number" min="0" class="currencyValue" id="output">
        </section>
        </form>';
        return $output;
    }

    public function custom_post_type() {
        register_post_type('book', ['public' => true, 'label' => 'Books']);
    }
}