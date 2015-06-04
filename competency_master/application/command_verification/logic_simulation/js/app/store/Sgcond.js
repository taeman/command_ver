Ext.define('COND.store.Sconds',{
	extend: 'Ext.data.Store',
	model: 'COND.model.Mcondgroup',
	autoLoad: true,
    autoSync: false,
	remoteSort: false,
    pageSize: 15,
	proxy: {
		type: 'ajax',
		api: {
			read: 'js/app/data/php/get_gcondition_list.php'
		},
		actionMethods: {
			read: 'POST'
		},
		reader: {
			type: 'json',
			root: 'data',
            totalProperty: 'totals',
			successProperty: 'success'
		}
	}
});