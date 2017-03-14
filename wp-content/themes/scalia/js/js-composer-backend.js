(function ($) {
	var Shortcodes = vc.shortcodes;
	var VcScClass = vc.shortcode_view.extend({
		events:{
			'click > .vc_controls .column_delete': 'deleteShortcode',
			'click > .vc_controls .column_edit': 'editElement',
			'click > .vc_controls .column_clone': 'clone',
			'click > .vc_controls .column_prepend': 'prependElement',
			'click > .vc_controls .column_add': 'addElement',
			'click > .vc_empty-element': 'appendElement',
		}
	})

	window.VcScAlertBoxView = VcScClass.extend({});
	window.VcScCounterBoxView = VcScClass.extend({});
	window.VcScFullwidthView = VcScClass.extend({});
	window.VcScIconWithTextView = VcScClass.extend({});
	window.VcScMapWithTextView = VcScClass.extend({});
	window.VcScPricingColumnView = VcScClass.extend({});
	window.VcScPricingTableView = VcScClass.extend({});
	window.VcScTextboxView = VcScClass.extend({});
})(window.jQuery);
