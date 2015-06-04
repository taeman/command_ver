Ext.define('COND.view.logictree.Variabletreelist', {
	extend: 'Ext.tree.Panel',
	alias: 'widget.variabletreelist',
	store: 'Variabletreestore',
	title: 'คลังตัวแปร',
	rootVisible: false,
	width: 300,
	layout: 'fit',
	useArrows: false,
    viewConfig: {
        allowContainerDrops: false,
        plugins: {
            enableDrag: true,
            ddGroup: 't2div',
            ptype:'treeviewdragdrop'
        }
    },
        listeners: {
            render: initializeItemDragZone
        }




});

function initializeItemDragZone(v) {
    //console.log(v.itemSeletor);
    v.dragZone = new Ext.dd.DragZone(v.getEl(),{
        
        getDragData: function(e) {
            var sourceEl = e.getTarget(v.itemSelector,10);

            if(sourceEl) {
                d = sourceEl.cloneNode(true);
                d.id = Ext.id();
                return {
                    sourceEl: sourceEl,
                    repairXY: Ext.fly(sourceEl).getXY(),
                    ddel: d,
                    sourceStore: v.store,
                    itemData: v.getRecord(sourceEl),
                    draggedRecord: v.getRecord(sourceEl)
                    
                }
            }
        },
        repairXY: function() {
            return this.dragData.repairXY;
        }
    });
}