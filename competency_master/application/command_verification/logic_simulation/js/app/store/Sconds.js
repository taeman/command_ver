Ext.define('COND.store.Sconds',{
	extend: 'Ext.data.Store',
	model: 'COND.model.Mcond',
	autoLoad: true,
    autoSync: false,
	remoteSort: false,
    pageSize: 15,
	proxy: {
		type: 'ajax',
		api: {
			read: 'js/app/data/php/get_condition_list.php'
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