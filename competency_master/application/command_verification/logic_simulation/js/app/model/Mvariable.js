Ext.define('COND.model.Mvariable',{
    extend: 'Ext.data.Store',
    fields: [
        {
            name: 'var_id',
            type: 'int'
        },
        {
            name: 'var_name',
            type: 'string'
        },
        {
            name: 'var_detail',
            type: 'string'
        },
        {
            name: 'var_eval',
            type: 'string'
        },
        {
            name: 'var_type',
            type: 'int'
        },
        {
            name: 'var_status',
            type: 'int'
        },
        {
            name: 'var_update',
            type: 'string'
        }
    ]
});