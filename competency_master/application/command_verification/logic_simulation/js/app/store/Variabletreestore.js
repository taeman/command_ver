Ext.define('COND.store.Variabletreestore', {
	extend: 'Ext.data.TreeStore',
    model: 'COND.model.Mvariable',
	autoLoad: true,
    autoSync: false,
	remoteSort: false,
	proxy: {
		type: 'ajax',
		api: {
			read: 'js/app/data/php/get_var_list.php?mod=treejson'
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
