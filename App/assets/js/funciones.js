
    //-----------------------------------
    //  Funciones anonimas (ejecucion automatica)
    //-----------------------------------

    // (function(){ alert("Ejecutado automaticamente"); }());




    function multiToggleButton(target, selector){
        if( !target.hasClass(selector) )
            target.addClass(selector);
        else
            target.removeClass(selector);
    }

    function singleToggleButton(target, selector){
        var clase = "."+selector;

        if( target.hasClass(selector) )
            target.removeClass(selector);
        else{
            //Le quita el class al elemento que lo tiene
            $(clase).removeClass(selector);
            //Se lo pone al target
            target.addClass(selector);
        }
    }

    function hideAndShow(hide, show){
        hide.slideUp();
        setTimeout(function(){
            show.slideDown();
        }, 1000);
    }

    function addAndRemoveClass(toAdd, toRemove, className) {
        toRemove.removeClass(className);
        toAdd.addClass(className);

    }