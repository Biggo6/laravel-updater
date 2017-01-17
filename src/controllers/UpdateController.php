<?php

namespace Biggo6\LaravelUpdater\Controllers;

use Naneau\SemVer\Compare;
use Naneau\SemVer\Parser;

class UpdateController extends \BaseController {
	public function check(){
		//Parse local version file
        $versionFile = base_path('version.json');
        if (! file_exists($versionFile)) {
            return \View::make('self-updater::error')->with('error', 'No version file found.');
        }
        $localVersionFile = file_get_contents(base_path('version.json'));
        $localVersionJson = json_decode($localVersionFile, true);
        //Parse remote version file
        $remoteVersionFile = @file_get_contents(config('self-updater.remote_uri').'/remote_version.json');
        if ($remoteVersionFile === false) {
            return \View::make('self-updater::error')->with('error', 'Can not read remote version file.');
        }
        $remoteVersionJson = json_decode($remoteVersionFile, true);
        $remoteVersion = $remoteVersionJson['version'];
        $localVersion = $localVersionJson['version'];
        $newVersion = Compare::greaterThan(
            Parser::parse($remoteVersion),
            Parser::parse($localVersion)
        );
        return \View::make('self-updater::checker', compact('localVersion', 'remoteVersion', 'newVersion'));
	}
}