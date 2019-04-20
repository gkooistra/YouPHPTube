<script>
    var playListsAdding = false;
    var playList = [];
    function reloadPlayLists() {
        $.ajax({
            url: webSiteRootURL + 'objects/playlists.json.php',
            success: function (response) {
                playList = response;
            }
        });
    }
    function loadPlayLists(videos_id, crc) {
        $.ajax({
            url: '<?php echo $global['webSiteRootURL']; ?>objects/playlists.json.php',
            cache: true,
            success: function (response) {
                $('.searchlist' + videos_id+crc).html('');
                for (var i in response) {
                    if (!response[i].id) {
                        continue;
                    }
                    var icon = "lock"
                    if (response[i].status == "public") {
                        icon = "globe"
                    }
                    var checked = "";
                    for (var x in response[i].videos) {
                        if (typeof (response[i].videos[x]) === 'object' && response[i].videos[x].videos_id == videos_id) {
                            checked = "checked";
                        }
                    }
                    $(".searchlist" + videos_id+crc).append('<a class="list-group-item"><i class="fa fa-' + icon + '"></i> <span>'
                            + response[i].name + '</span><div class="material-switch pull-right"><input id="someSwitchOptionDefault'
                            + response[i].id + videos_id + '" name="someSwitchOption' + response[i].id + videos_id + '" class="playListsIds' + videos_id + ' playListsIds' + response[i].id + ' " type="checkbox" value="'
                            + response[i].id + '" ' + checked + '/><label for="someSwitchOptionDefault'
                            + response[i].id + videos_id + '" class="label-success"></label></div></a>');

                }
                $('.searchlist' + videos_id+crc).btsListFilter('#searchinput' + videos_id+crc, {itemChild: 'span'});
                $('.playListsIds' + videos_id).change(function () {
                    if(playListsAdding){
                        return false;
                    }
                    playListsAdding = true;
                    modal.showPleaseWait();

                    //tmp-variables simply make the values avaible on success.
                    tmpPIdBigVideo = $(this).val();
                    tmpSaveBigVideo = $(this).is(":checked");
                    $.ajax({
                        url: '<?php echo $global['webSiteRootURL']; ?>objects/playListAddVideo.json.php',
                        method: 'POST',
                        data: {
                            'videos_id': videos_id,
                            'add': $(this).is(":checked"),
                            'playlists_id': $(this).val()
                        },
                        success: function (response) {
                            $(".playListsIds" + tmpPIdBigVideo).prop("checked", tmpSaveBigVideo);
                            modal.hidePleaseWait();
                            setTimeout(function(){playListsAdding=false},500);
                        }
                    });
                    return false;
                });
            }
        });
    }


    $(document).ready(function () {
        reloadPlayLists();
    });
</script>
