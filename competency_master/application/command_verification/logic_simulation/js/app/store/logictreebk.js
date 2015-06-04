Ext.define('CMUI.store.Logictrees', {
	
	extend: 'Ext.data.TreeStore',
	
	autoLoad: true,
	remoteSort: false,
	proxy: {
		type: 'ajax',
		api: {
			read: 'assets/app/data/logictree.json'
		},
		actionMethod: 'POST',
		reader: {
			type: 'json',
			root: 'data',
			successProperty: 'success'
		}
	}
});
