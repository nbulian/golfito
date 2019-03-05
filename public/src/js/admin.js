$(document).ready(function(){
    initHeader();
});

function initHeader() {
    $('#create').click(function( e ) {
        $('#loading').modal('show');
        $( "#menu" ).trigger( "click" );
        
        $.ajax({
            url : 'create-step1',
            type : 'GET',
            dataType : 'html',
            success : function(response) {
                console.log(response);
                $('#content').html( response );
            },
            error : function(xhr, status) {
                alert('There was a problem, please try again.');
            },
            complete: function(){
                $('#loading').modal('hide');
            }
        });
        
        e.preventDefault();
    });
    
    $('#h2h-step1').click(function( e ) {
        $('#loading').modal('show');
        $( "#menu" ).trigger( "click" );
        
        $.ajax({
            url : 'h2h-step1',
            type : 'GET',
            dataType : 'html',
            success : function(response) {
                console.log(response);
                $('#content').html( response );
            },
            error : function(xhr, status) {
                alert('There was a problem, please try again.');
            },
            complete: function(){
                $('#loading').modal('hide');
            }
        });
        
        e.preventDefault();
    });
    
    $('#players').click(function( e ) {
        $('#loading').modal('show');
        $( "#menu" ).trigger( "click" );
        
        $.ajax({
            url : 'players',
            type : 'GET',
            dataType : 'html',
            success : function(response) {
                console.log(response);
                $('#content').html( response );
            },
            error : function(xhr, status) {
                alert('There was a problem, please try again.');
            },
            complete: function(){
                $('#loading').modal('hide');
            }
        });
        
        e.preventDefault();
    });
}

function initSetp1() {
    $('#step1').click(function( e ) {
        $('#loading').modal('show');
        
        $.ajax({
            url : 'save-step1',
            data: $("#form_step1").serialize(),
            type : 'POST',
            dataType : 'html',
            success : function(response) {
                console.log(response);
                $('#content').html( response );
            },
            error : function(xhr, status) {
                alert('There was a problem, please try again.');
            },
            complete: function(){
                $('#loading').modal('hide');
            }
        });
        
        e.preventDefault();
    });
}

function initSetp2() {
    $('#step2').click(function( e ) {
        $('#loading').modal('show');
        
        $.ajax({
            url : 'save-step2',
            data: $("#form_step2").serialize(),
            type : 'POST',
            dataType : 'html',
            success : function(response) {
                console.log(response);
                $('#content').html( response );
            },
            error : function(xhr, status) {
                alert('There was a problem, please try again.');
            },
            complete: function(){
                $('#loading').modal('hide');
            }
        });
        
        e.preventDefault();
    });
}

function initH2hSetp1() {
    $('#h2h-step2').click(function( e ) {
        $('#loading').modal('show');
        
        $.ajax({
            url : 'h2h-step2',
            data: $("#form_h2h-step1").serialize(),
            type : 'POST',
            dataType : 'html',
            success : function(response) {
                console.log(response);
                $('#content').html( response );
            },
            error : function(xhr, status) {
                alert('There was a problem, please try again.');
            },
            complete: function(){
                $('#loading').modal('hide');
            }
        });
        
        e.preventDefault();
    });
}

function initNewPlayer() {
    $('#new-player').click(function( e ) {
        $('#loading').modal('show');
        
        $.ajax({
            url : 'new-player',
            type : 'GET',
            dataType : 'html',
            success : function(response) {
                console.log(response);
                $('#content').html( response );
            },
            error : function(xhr, status) {
                alert('There was a problem, please try again.');
            },
            complete: function(){
                $('#loading').modal('hide');
            }
        });
        
        e.preventDefault();
    });
}

function initCreatePlayer() {
    $('#create-player').click(function( e ) {
        $('#loading').modal('show');
        
        $.ajax({
            url : 'create-player',
            data: $("#form_players_step1").serialize(),
            type : 'POST',
            dataType : 'html',
            success : function(response) {
                console.log(response);
                $('#content').html( response );
            },
            error : function(xhr, status) {
                alert('There was a problem, please try again.');
            },
            complete: function(){
                $('#loading').modal('hide');
            }
        });
        
        e.preventDefault();
    });
}
