Ext.define('COND.model.Mcond',{
	extend: 'Ext.data.Model',
	fields: [{
		    name: 'cond_id',
		    type: 'int'
		},{
		    name: 'cond_name',
			type: 'string'
		},{
			name: 'cond_detail',
			type: 'string'
		},{
			name: 'cond_status',
			type: 'int'
		},{
			name: 'cond_update',
			type: 'date'
		},{
            name: 'gcond_id',
            type: 'int'
        }
	]
});