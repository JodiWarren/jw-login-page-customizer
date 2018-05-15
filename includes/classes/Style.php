<?php

namespace JwLoginCustomizer\Style;

class Style {

	private $selector = '';
	private $styles = [];

	public function __construct($selector) {
		$this->selector($selector);
	}

	/**
	 * @param $selector string CSS selector to add
	 */
	public function selector($selector) {
		$this->selector = $selector;
	}

	/**
	 * @param $style string CSS property/value string to add.
	 */
	public function addStyle($style) {
		$this->styles[] = $style;
	}

	public function output() {
		if (count($this->styles) === 0) {
			return '';
		}

		$styles = join(";\n", $this->styles);

		ob_start(); ?>
		<?= $this->selector ?> {
			<?= $styles ?>
		}
		<?php
		return ob_get_clean();
	}

}
