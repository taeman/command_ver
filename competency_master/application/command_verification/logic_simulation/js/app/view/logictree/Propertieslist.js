Ext.define('COND.view.logictree.Propertieslist',{
	extend: 'Ext.tree.Panel',
	alias: 'widget.propertieslist',
	store: 'Propertiestreestore',
	title: 'เงื่อนไขที่มีอยู่แล้ว',
	rootVisible: false,
	floatable: false,
	width: 300,

    height: '50%',
	collapsible: true,
	layout: 'fit',
	useArrows: true,
	enableDD: true,
	viewConfig: {
		plugins: {
			ptype: 'treeviewdragdrop',
			appendOnly: true
		}
	}
});
