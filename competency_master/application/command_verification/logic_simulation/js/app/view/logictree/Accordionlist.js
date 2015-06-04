Ext.define('COND.view.logictree.Accordionlist', {
	extend: 'Ext.panel.Panel',
	alias: 'widget.accordionlist',
	layout: 'accordion',
	collapsible: true,
    width: 250,
    layoutConfig: {
        // layout-specific configs go here
        titleCollapse: false,
        animate: true,
        activeOnTop: true
    },
    items: [{
    	xtype: 'propertieslist'
    },{
    	xtype: 'variabletreelist'
    }]
	
});
