var getCratesForSong = function( song_id )
{
    $.ajax({
        url: crateurl + "/ajaxgetcratesforsong/id/" + song_id, 
        context: document.body,
        success: function( data ){
            if( data != 'fail' )
            {
                jQuery( '#crates_for_' + song_id ).html( data );
            }
        }
    });
}

var getSongsForCrate = function( crate_id )
{
    $.ajax({
        url: crateurl + "/ajaxgetsongsforcrate/id/" + crate_id, 
        context: document.body,
        success: function( data ){
            if( data != 'fail' )
            {
                jQuery( '#songs_for_crate_' + crate_id ).html( data );
            }
        }
    });
}

jQuery( '.add_to_crate_submit' ).click(function(){
    raw_song_id = this.id;
    song_id = raw_song_id.replace( 'sid_', '' );
    crate_name = jQuery( '#add_to_crate_' + song_id ).val();
    if( song_id && crate_name )
    {
        $.ajax({
            url: crateurl + "/ajaxaddsongtocrate/sid/" + song_id + "/cratename/" + crate_name, 
            context: document.body,
            success: function( data ){
                if( data != 'fail' )
                {
                    getCratesForSong( song_id );
                    jQuery( '#add_to_crate_' + song_id ).val( '' );
                }
            }
        }); 
    }
});
