Ext.define('COND.view.logictree.Droppanel',{
	extend: 'Ext.panel.Panel',
	alias: 'widget.cmuidroppanel',
    id: 'vardroptarget',
    width: 250,
    height: 300,
    layout: 'fit',
    title: 'กรุณาเลือกเงื่อนไขก่อนสร้างตรรกะ',
    enableDrop: true,
    html: '<div class="vardroppanel" value="0" style="padding: 5px; border: 1px dashed #00008b; height: 192px;"></div><div style="text-align: right;padding: 5px;">ลากตัวแปรวางในกรอบเส้นประ</div>',
    tbar: [{
        text: '((',
        handler: function() {
            addOperation('((','((');

        }
    },{
        text: '(',
        handler: function() {
            addOperation('(','(');
                
        }
    },{
        text: '<',
        handler: function() {
            addOperation('<','<')
        }
    },{
        text: '<=',
        handler: function() {
            addOperation('<=','<=')
        }
    },{
        text: '=',
        handler: function() {
            addOperation('=','==')
        }
    },{
        text: '>',
        handler: function() {
            addOperation('>=','>=')
        }
    },{
        text: '>=',
        handler: function() {
            addOperation('>','>')
        }
    },{
        text: ')',
        handler: function() {
            addOperation(')',')')
        }
    },{
        text: '))',
        handler: function() {
            addOperation('))','))');

        }
    },{
        text: 'จริง',
        handler: function() {
            addOperation('จริง','true')
        }
    },{
        text: 'เท็จ',
        handler: function() {
            addOperation('เท็จ','false')
        }
    },{
        text: 'และ',
        handler: function() {
            addOperation('และ','&&')
        }
    },{
        text: 'หรือ',
        handler: function() {
            addOperation('หรือ','||')
        }
    }],
    dockedItems: [{
        dock: 'bottom',
        xtype: 'toolbar',
        items: ['->',{
            text: 'บันทึก',
            handler: function(e) {
                var els = Ext.select('div.logic_button',true).elements;
                var tx = '';
                var texthtml = '';
                var v = null;
                var cond_id = Ext.select('div.vardroppanel').elements[0].getAttribute('value');
                if(cond_id > 0) {
                    if(els.length > 0) {
                        Ext.Array.forEach(els,function(item, idx, allitems){
                            v = item.dom.getAttribute('value').toString();
                            tx = tx + '' + v;
                            texthtml = texthtml + Ext.String.format('<div class="logic_button" value="{0}"></div>',v);
                        }, els);

                        //console.log(texthtml);


                        Ext.Ajax.request({
                            url: 'js/app/data/php/get_condition_list.php',
                            params: {
                                cond_id: cond_id,
                                cond_eval: tx,
                                cond_html: texthtml,
                                mod: 'eval'
                            },
                            success: function() {
                                Ext.Msg.alert('Info','บันทึกข้อมูลเสร็จเรียบร้อย');
                            }

                        });

                        //Ext.Msg.alert(tx);
                    }
                    else {
                        Ext.Msg.show({
                            title: 'Warning',
                            msg: 'กรุณานำเงื่อนไขมาทำตรรกะก่อนกด "บันทึก"',
                            buttons: Ext.Msg.OK,
                            icon: Ext.Msg.WARNING,
                            closable: false
                        });
                    }

                }
                else {
                    Ext.Msg.show({
                            title: 'Warning',
                            msg: 'กรุณากดปุ่มสร้างตรรกะของแต่ละเงื่อนไข<br/>ก่อนสร้างตรรกะ',
                            buttons: Ext.Msg.OK,
                            icon: Ext.Msg.WARNING,
                            closable: false
                        });

                }

                

            }
        }]
    }],
    afterRender: function(v) {
        


        Ext.Panel.prototype.afterRender.apply(this, arguments);
        this.dropTarget = this.body.child('div.vardroppanel');

        
        
        var dd = new Ext.dd.DropTarget(this.dropTarget,{
            ddGroup: 't2div',
            notifyDrop: function(dd, e, node) {
                var data = dd.dragData.records[0];

                //console.log(dd.dragData.stores);

                var id = Ext.id();
                var t = Ext.getCmp('vardroptarget').body.child('div');
                var dh = Ext.DomHelper;
                dh.append(t,{'tag':'div','id':'logic-'+id,'class':'logic_button','value':data.data.id});

				Ext.Function.defer(function() {
					Ext.create('Ext.button.Button',{
						text: data.data.text,
						renderTo: Ext.get('logic-'+id),
                        margin: '1 2 1 0',
                        arrowAlign: 'bottom',
                        enableDrag: true,
                        ddGroup: 't2div',
                        scale: 'large',
                        menu: {
                            items: [{
                                text: 'ลบ',
                                handler: function() {
                                    Ext.get('logic-'+id).remove();
                                }
                            }]
                        },
						handler: function() {

						}
					});
				}, 1);

                Ext.fly('logic-'+id).frame('#034d8a');

                return true;
            },
            notifyEnter: function(dd, e, node) {
                //console.log(node);
                //return true;
            }
        });

    }


});

function addOperation(msg, value) {
    var id = Ext.id();
	Ext.Function.defer(function() {
		Ext.create('Ext.button.Button',{
			text: msg,
	    	renderTo: Ext.get('logic-'+id),
            margin: '1 2 1 0',
            arrowAlign: 'bottom',
            enableDrag: true,
            ddGroup: 't2div',
            scale: 'large',
            menu: {
                items: [{
                    text: 'ลบ',
                    handler: function() {
                        //console.log(id);
                        Ext.get('logic-'+id).remove();

                    }
                }]
            },
			handler: function() {

			}
		});

        Ext.fly('logic-'+id).frame('#034d8a');
	}, 25);
    
    var t = Ext.getCmp('vardroptarget').body.child('div');
    var dh = Ext.DomHelper;
    dh.append(t,{'tag':'div','id':'logic-'+id,'class':'logic_button','value':value});


}
