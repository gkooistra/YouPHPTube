<?php

global $global;
require_once $global['systemRootPath'] . 'plugin/Plugin.abstract.php';

class CustomizeAdvanced extends PluginAbstract {


    public function getDescription() {
        $txt = "Fine Tuning your YouPHPTube";
        $help = "<br><small><a href='https://github.com/DanielnetoDotCom/YouPHPTube/wiki/Advanced-Customization-Plugin' target='__blank'><i class='fas fa-question-circle'></i> Help</a></small>";
        return $txt.$help;
    }

    public function getName() {
        return "CustomizeAdvanced";
    }

    public function getUUID() {
        return "55a4fa56-8a30-48d4-a0fb-8aa6b3f69033";
    }

    public function getPluginVersion() {
        return "1.0";   
    }    
    
    public function getEmptyDataObject() {
        global $global;
        $obj = new stdClass();
        $obj->logoMenuBarURL = $global['webSiteRootURL'];
        $obj->encoderNetwork = "https://network.youphptube.com/";
        $obj->useEncoderNetworkRecomendation = false;
        $obj->doNotShowEncoderNetwork = true;
        $obj->doNotShowUploadButton = false;
        $obj->uploadButtonDropdownIcon = "fas fa-video";
        $obj->uploadButtonDropdownText = "";
        $obj->encoderNetworkLabel = "";
        $obj->doNotShowUploadMP4Button = true;
        $obj->uploadMP4ButtonLabel = "";
        $obj->doNotShowImportMP4Button = true;
        $obj->importMP4ButtonLabel = "";
        $obj->doNotShowEncoderButton = false;
        $obj->encoderButtonLabel = "";
        $obj->doNotShowEmbedButton = false;
        $obj->embedButtonLabel = "";
        $obj->doNotShowEncoderResolutionLow = false;
        $obj->doNotShowEncoderResolutionSD = false;
        $obj->doNotShowEncoderResolutionHD = false;
        $obj->doNotShowLeftMenuAudioAndVideoButtons = false;
        $obj->doNotShowWebsiteOnContactForm = false;
        $obj->doNotUseXsendFile = false;
        $obj->makeVideosInactiveAfterEncode = false;
        $obj->usePermalinks = false;
        $obj->showAdsenseBannerOnTop = false;
        $obj->showAdsenseBannerOnLeft = true;
        $obj->disableAnimatedGif = false;
        $obj->removeBrowserChannelLinkFromMenu = false;
        $obj->EnableWavesurfer = false;
        $obj->EnableMinifyJS = false;
        $obj->disableShareAndPlaylist = false;
        $obj->commentsMaxLength = 200;
        $obj->disableYoutubePlayerIntegration = false;
        $obj->utf8Encode = false;
        $obj->utf8Decode = false;
        $obj->embedBackgroundColor = "white";
        $o = new stdClass();
        $o->type = "textarea";
        $o->value = "";        
        $obj->menuBarHTMLCode = $o;
        $o->type = "textarea";
        $o->value = "";        
        $obj->underMenuBarHTMLCode = $o;
        $obj->signInOnRight= true;
        $obj->signInOnLeft= true;
        $obj->forceCategory= false;
        $obj->autoPlayAjax= false;

        $plugins = Plugin::getAllEnabled();
        //import external plugins configuration options
        foreach ($plugins as $value) {
            $p = YouPHPTubePlugin::loadPlugin($value['dirName']);
            if (is_object($p)) {
                $foreginObjects=$p->getCustomizeAdvancedOptions();
                if($foreginObjects)
                {
                    foreach($foreginObjects as $optionName => $defaultValue)
                    $obj->{$optionName}=$defaultValue;
                }
            }
        }
                
        $obj->disableHelpLeftMenu= false;
        $obj->disableAboutLeftMenu= false;
        $obj->disableContactLeftMenu= false;
        $obj->disableNavbar= false;
        $obj->videosCDN = "";
        $obj->useFFMPEGToGenerateThumbs = false;
        $obj->showImageDownloadOption = false;
        
        return $obj;
    }
    
    public function getHelp(){
        if(User::isAdmin()){
            return "<h2 id='CustomizeAdvanced help'>CustomizeAdvanced (admin)</h2><p>".$this->getDescription()."</p><table class='table'><tbody><tr><td>EnableWavesurfer</td><td>Enables the visualisation for audio. This will always download full audio first, so with big audio-files, you might better disable it.</td></tr><tr><td>commentsMaxLength</td><td>Maximum lenght for comments in videos</td></tr><tr><td>disableYoutubePlayerIntegration</td> <td>Disables the integrating of youtube-videos and just embed them.</td></tr><tr><td>EnableMinifyJS</td><td>Minify your JS. Clear videos/cache after changing this option.</td></tr></tbody></table>";   
        }
        return "";
    }
    
    public function getTags() {
        return array('free', 'customization', 'buttons', 'resolutions');
    }
}
