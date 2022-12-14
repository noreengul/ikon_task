var skeletonId = 'skeleton';
var contentId = 'content';
var skipCounter = 0;
var takeAmount = 10;


function getRequests(mode) {

    $('#skeleton').removeClass( 'd-none' );
    $('#content').addClass( 'd-none' );

    var url ='';
    if(mode=='sent')
        url=app_url +'/sent_requests' ;

    if(mode=='received')
        url=app_url +'/received_requests' ;

    $.ajax({
        url:url,
    }).done(function(response) {
        $('#content').html( response.data );
        $('#content').removeClass( 'd-none' );
        $('#skeleton').addClass( 'd-none' );

        showcounts(response.counts);
    });
}

function getMoreRequests(mode) {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getConnections(url) {

    $('#skeleton').removeClass( 'd-none' );
    $('#content').addClass( 'd-none' );
    $.ajax({
        url:app_url +'/connections' ,
    }).done(function(response) {
        $('#content').html( response.data );
        $('#content').removeClass( 'd-none' );
        $('#skeleton').addClass( 'd-none' );

        showcounts(response.counts);
    });
}

function getMoreConnections() {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getConnectionsInCommon(userId, connectionId) {
  // your code here...
}

function getMoreConnectionsInCommon(userId, connectionId) {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getSuggestions() {

    $('#skeleton').removeClass( 'd-none' );
    $('#content').addClass( 'd-none' );
    $.ajax({
        url:app_url+'/suggestions' ,
    }).done(function(response) {

        showcounts(response.counts);

        $('#content').html( response.data );

        $('#content').removeClass( 'd-none' );
        $('#skeleton').addClass( 'd-none' );
    });
}

function getMoreSuggestions() {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function sendRequest(userId, suggestionId) {

    $('#skeleton').removeClass( 'd-none' );
    $('#content').addClass( 'd-none' );
    $.ajax({
        url:app_url+'/sent-invitation/'+suggestionId,
    }).done(function(response) {

        showcounts(response.counts);

        $('#content').html( response.data );

        $('#content').removeClass( 'd-none' );
        $('#skeleton').addClass( 'd-none' );
    });

}

function deleteRequest(userId, requestId) {
    $('#skeleton').removeClass( 'd-none' );
    $('#content').addClass( 'd-none' );
    $.ajax({
        url:app_url+'/withdraw-network/'+requestId,
    }).done(function(response) {

        showcounts(response.counts);

        $('#content').html( response.data );

        $('#content').removeClass( 'd-none' );
        $('#skeleton').addClass( 'd-none' );
    });
  // your code here...
}

function acceptRequest(userId, requestId) {
    $('#skeleton').removeClass( 'd-none' );
    $('#content').addClass( 'd-none' );
    $.ajax({
        url:app_url+'/accept-network/'+requestId,
    }).done(function(response) {

        showcounts(response.counts);

        $('#content').html( response.data );

        $('#content').removeClass( 'd-none' );
        $('#skeleton').addClass( 'd-none' );
    });

  // your code here...
}

function removeConnection(userId ) {

    $('#skeleton').removeClass( 'd-none' );
    $('#content').addClass( 'd-none' );
    $.ajax({
        url:  app_url+'/remove-network/'+userId ,
    }).done(function(response) {

        $('#content').html( response.data );

        showcounts(response.counts);

        $('#content').removeClass( 'd-none' );
        $('#skeleton').addClass( 'd-none' );
    });
}

function showcounts( response){

    $('#suggestion_count').html(response.suggestion_count );
    $('#connection_count').html( response.connections_count );
    $('#sent_count').html( response.sent_count );
    $('#received_count').html( response.received_count )
}

$(function () {
  getSuggestions(suggestion_url);
});
