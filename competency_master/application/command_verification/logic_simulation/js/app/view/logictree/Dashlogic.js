Ext.define('COND.view.logictree.Dashlogic',{
    extend: 'Ext.panel.Panel',
    alias: 'widget.dashlogic',
    title: '��ǹ�ͧ������ҧ��á�',
	layout: 'border',
    width: 400,
	defaults: {
	    split: true
	},
	items: [{
        xtype: 'accordionlist',
        region: 'center',
		padding: '5 0 5 5'
    }]
});