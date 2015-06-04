Ext.define('COND.view.cond.Listcond',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.listcond',
	store: 'Sconds',
	title: '�Ѵ������͹�',
    width: 500,
    collapsible: true,
	defaults: {
        sortable: false
    },
	tbar: [{
		text: '�������͹�',
		action: 'insert'
	}],
	
	columns: [
		{ header: 'ID', dataIndex: 'cond_id', flex: 1, hidden: true },
		{ header: '�������͹�', dataIndex: 'cond_name', flex: 1},
		{ header: 'ʶҹ�', dataIndex: 'cond_status', width: 50},
		{ header: '#', dataIndex: 'cond_id', width: 55,sortable: false,
			renderer: function(value, metaData, record, rowIndex,
  colIndex, store, view) {
				var id = Ext.id();
				Ext.Function.defer(function() {
					Ext.create('Ext.button.Button',{
						text: '���',
						renderTo: Ext.get('ed-'+id),
						handler: function() {
							var editWind = Ext.widget('listcondedit'); // call alias of Listedit.js file
							var editForm = editWind.down('form');  // down form to variable editForm
							editForm.loadRecord(record); // put all data in variable "grid" to this form
							//console.log('Form widget->listcondedit had created'); // show debut of this button
						}
					});
				}, 25);
				return Ext.String.format('<div id="ed-{0}" value="{1}">',id,value);
			}
		},
		{
			header: '#', dataIndex: 'cond_id', width: 40,sortable: false,
			renderer: function(value, metaData, record, rowIndex,
  colIndex, store, view) {
				var id = Ext.id();
				Ext.Function.defer(function() {

					Ext.create('Ext.button.Button',{
						text: 'ź',
						renderTo: Ext.get('del-'+id),
						scale: 'small',
						handler: function() {

                            Ext.Msg.show({
                                title: 'ź������',
                                msg: '�س��ͧ���ź���͹���顴 "Yes" �������ͧ�����顴 "No"',
                                buttons: Ext.Msg.YESNO,
                                icon: Ext.Msg.QUESTION,
                                fn: function(btn) {
                                    if(btn == 'yes') {
                                        Ext.Ajax.request({
                                            url: 'js/app/data/php/get_condition_list.php',
                                            params: {
                                                id: value,
                                                mod: 'delete'
                                            },
                                            success: function() {
                                                store.load();
                                            }
                                        });
                                    }
                                }

                            });
						}

					});
				}, 25);
				return Ext.String.format('<div id="del-{0}" value="{1}"></div>',id,value);
			}
		},
		{ 
			header: '#', dataIndex: 'cond_id', width: 75,sortable: false,
			renderer: function(value, metaData, record, rowIndex,
  colIndex, store, view) {
				var id = Ext.id();
				Ext.Function.defer(function() {
										
					Ext.create('Ext.button.Button',{
						text: '���ҧ��á�',
						renderTo: Ext.get('lg-'+id),
						handler: function() {
                            var dp = Ext.getCmp('vardroptarget');
                            dp.body.child('div.vardroppanel').set({'value':record.data.cond_id});

                            /*
                            Ext.Msg.show({
                                title: '��駤�Ңͧ��á�����͹䢹��',
                                msg: '�س������¹������ҧ���͹��繢ͧ����� <br /> '+record.data.cond_name,
                                
                                buttons: Ext.Msg.OK,
                                icon: Ext.Msg.INFO,
                                closable: false
                            });
                            */

                            dp.setTitle('���͹� - ' + record.data.cond_name);

                            Ext.Ajax.request({
                                url: 'js/app/data/php/get_condition_list.php',

                                params: {
                                    cond_id: value,
                                    mod: 'ghtml'
                                },
                                success: function(response) {
                                    dp.body.child('div.vardroppanel').update(response.responseText);
                                    var els = Ext.select('div.logic_button',true).elements;
                                    var div = null;
                                    var condname;

                                    //console.log(els);
                                    if(els.length > 0) {
                                        Ext.Array.forEach(els,function(item, idx, allitems){
                                            var v = item.dom.getAttribute('value').toString();

                                            if(!isNaN(v)) {


                                                condname = $.ajax({
                                                    url:'js/app/data/php/get_condition_list.php',
                                                    type: 'POST',
                                                    data: 'mod=name&var_id='+v,
                                                    async: false

                                                }).responseText;

                                                //condname.charset('windows-874');

                                            }
                                            else
                                            {
                                                condname = convertString(v);
                                            }



                                            div = Ext.get(item.id);
                                            Ext.create('Ext.button.Button',{
                                                text: condname,
                                                renderTo: item.id,
                                                margin: '1 2 1 0',
                                                arrowAlign: 'bottom',
                                                enableDrag: true,
                                                ddGroup: 't2div',
                                                scale: 'large',
                                                menu: {
                                                    items: [{
                                                        text: 'ź',
                                                        handler: function() {

                                                            Ext.get(item.id).remove();

                                                        }
                                                    }]
                                                },
                                                handler: function() {

                                                }
                                            });


                                            //console.log(div);
                                        }, els);

                                    }
                                }
                            });

                        }
						
					});
					
					
				}, 25);
				return Ext.String.format('<div id="lg-{0}" value="{1}"></div>',id,value);
			}
		}
	],
	
	dockedItems: [{
		xtype: 'pagingtoolbar',
        beforePageText: '˹��',
        afterPageText: '�ҡ������ {0} ˹��',
        displayMsg: '�ӹǹ {0} - {1} �ҡ {2}',
		store: 'Sconds',
		dock: 'bottom',
		displayInfo: true
	}],
	sortable: false,
	columnLines: true
});

function convertString(operator) {
    if(operator == '==') {
        return '=';
    }
    else if(operator == 'true') {
        return '��ԧ';
    }
    else if(operator == 'false') {
        return '��';
    }
    else if(operator == '&&') {
        return '���';
    }
    else if(operator == '||') {
        return '����';
    }
    else {
        return operator;
    }
}