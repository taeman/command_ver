Ext.define('COND.store.Propertiestreestore', {
	
	extend: 'Ext.data.TreeStore',
	model: 'COND.model.Mvariable',
	autoLoad: true,
    autoSync: true,
    async: true,
	remoteSort: false,
	proxy: {
		type: 'ajax',
        api: {
            read: 'js/app/data/php/get_condition_list.php?mod=treejson'
        },
        actionMethods: {
            read: 'POST'
        },
        reader: {
            type: 'json',
            root: 'data',
            successProperty: 'success'
        }
	}
});
