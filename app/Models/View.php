<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;

class View extends Model
{

	public static function getInfo()
	{
		$value=DB::table('basic_informations')->whereNull('deleted_at')->get();
		return $value;
	}

	public static function getMembers()
	{
		$value=DB::table('members')->whereNull('deleted_at')->get();
		return $value;
	}

	public static function getNews()
	{

		$apikey = "xlevVGZH4aADYBC1urdSXJieT0Iy6mx3ejRFqIqY4FFqKeOApI";
		$limit = 10;
		$tumblr = "fyeah-infinite.tumblr.com";

		$apidata = json_decode(file_get_contents("http://api.tumblr.com/v2/blog/$tumblr/posts?api_key=$apikey&limit=$limit&tag=t:news"));

		$results = $apidata->response->posts;

		return $results;
	}

	public static function getSubunits()
	{
		$value=DB::table('subunits')->orderBy('debut', 'asc')->where('id', '!=', '1')->get();
		return $value;
	}

	public static function getVarietyShows()
	{
		$value=DB::table('subunits')->whereNull('deleted_at')->orderBy('debut', 'asc')->get();
		return $value;
	}

	public static function getDiscography()
	{
		$value=DB::table('discographies')->leftJoin('subunits', 'discographies.subunit', '=', 'subunits.id')->select('discographies.*', 'subunits.name AS subunitname')->whereNull('discographies.deleted_at')->get();
		return $value;
	}

	public static function getSongs()
	{
		$value=DB::table('songs')->leftJoin('subunits', 'songs.subunit', '=', 'subunits.id')->select('songs.*', 'subunits.name AS subunitname')->whereNull('songs.deleted_at')->get();
		return $value;
	}

	public static function getTitleSongs()
	{
		$value=DB::table('songs')->where('titletrack', '=', '1')->get();
		return $value;
	}

	public static function getDisTypes()
	{
		$value=DB::table('discography_types')->whereNull('deleted_at')->get();
		return $value;
	}

	public static function getDramas()
	{
		$value=DB::table('dramas')->leftJoin('drama_types', 'dramas.type', '=', 'drama_types.id')->select('dramas.*', 'drama_types.name AS typed')->whereNull('dramas.deleted_at')->orderBy("dramas.released", "desc")->get();
		return $value;
	}


	public static function getVarieties()
	{
		$value=DB::table('variety_shows')->whereNull('deleted_at')->orderBy('Year', 'ASC')->get();
		return $value;
	}

	public static function getConcerts()
	{
		$value=DB::table('concerts')->whereNull('deleted_at')->orderBy('Year', 'ASC')->get();
		return $value;
	}

	public static function getMVs()
	{
		$value=DB::table('music_videos')->leftJoin('songs', 'music_videos.song', '=', 'songs.id')->select('music_videos.*', 'songs.titles AS title')->whereNull('music_videos.deleted_at')->orderBy('date', 'DESC')->get();
		return $value;
	}

	public static function getAwards()
	{
		$value=DB::table('awards')->select(DB::raw('*, YEAR(received) as Year'))->whereNull('deleted_at')->orderBy('received', 'ASC')->get();
		return $value;
	}

	public static function getAwardYears()
	{
		$value=DB::table('awards')->select(DB::raw('DISTINCT YEAR(received) as Year'))->whereNull('deleted_at')->orderBy('received', 'ASC')->get();
		return $value;
	}

	public static function getAwardSongs()
	{
		$value=DB::table('awards')->select(DB::raw('DISTINCT awards.for'))->whereNull('deleted_at')->orderBy('received', 'ASC')->get();
		return $value;
	}


	public static function getRoles()
	{
		$value=DB::table('drama_roles')->leftJoin('members', 'members.id', '=', 'drama_roles.actor')->select('drama_roles.*', 'members.shortname AS member')->whereNull('drama_roles.deleted_at')->get();
		return $value;
	}

	public static function getSubunitDisco($id)
	{
		$value=DB::table('discographies')->leftJoin('subunits', 'discographies.subunit', '=', 'subunits.id')->select('discographies.*', 'subunits.name AS subunitname')->whereNull('discographies.deleted_at')->where('subunit', '=', $id)->get();
		return $value;
	}

	public static function getAlbum($id)
	{
		$value=DB::table('discographies')->leftJoin('subunits', 'discographies.subunit', '=', 'subunits.id')->select('discographies.*', 'subunits.name AS subunitname')->whereNull('discographies.deleted_at')->where('discographies.id', '=', $id)->get();
		return $value;
	}

	public static function getAlbumSongs($id)
	{
		$value=DB::table('songs')->where('album', 'LIKE', '%"'.$id.'"%')->whereNull('deleted_at')->get();
		return $value;
	}

	public static function getDramaDetail($id)
	{
		$value=DB::table('dramas')->leftJoin('drama_types', 'dramas.type', '=', 'drama_types.id')->select('dramas.*', 'drama_types.name AS typed')->whereNull('dramas.deleted_at')->where('dramas.id', '=', $id)->get();
		return $value;
	}

	public static function getDramaRoles($id)
	{
		$value=DB::table('drama_roles')->leftJoin('members', 'members.id', '=', 'drama_roles.actor')->select('drama_roles.*', 'members.shortname AS member')->whereNull('drama_roles.deleted_at')->where('drama_roles.project', '=', $id)->get();
		return $value;
	}

	public static function getDramaEpisodes($id)
	{
		$value=DB::table('drama_episodes')->whereNull('deleted_at')->where('drama', '=', $id)->get();
		return $value;
	}

	public static function getVarietyDetail($id)
	{
		$value=DB::table('variety_shows')->whereNull('deleted_at')->where('id', '=', $id)->get();
		return $value;
	}

	public static function getVarietyEpisodes($id)
	{
		$value=DB::table('varshow_episodes')->whereNull('deleted_at')->where('varshow', '=', $id)->get();
		return $value;
	}

	public static function getMemberDetail($id)
	{
		$value=DB::table('members')->whereNull('deleted_at')->where('id', '=', $id)->get();
		return $value;
	}

	public static function getMemberDramas($id)
	{
		$value=DB::table('drama_roles')->leftJoin('dramas', 'dramas.id', '=', 'drama_roles.project')->whereNull('drama_roles.deleted_at')->where('drama_roles.actor', '=', $id)->get();
		return $value;
	}

	public static function getMemberAlbums($id)
	{
		$value=DB::table('discographies')->whereNull('deleted_at')->where('member', 'like', '%"'.$id.'"%')->get();
		return $value;
	}

	public static function getMemberSongs($id)
	{
		$value=DB::table('songs')->whereNull('deleted_at')->where('members', 'like', '%"'.$id.'"%')->get();
		return $value;
	}

	public static function getMemberVarshow($id)
	{
		$value=DB::table('variety_shows')->whereNull('deleted_at')->where('member', 'like', '%"'.$id.'"%')->get();
		return $value;
	}

	public static function getMemberCompositions($id)
	{
		$value=DB::table('compositions')->leftJoin('songs', 'songs.id', '=', 'compositions.song')->select('compositions.*', 'songs.titles')->whereNull('compositions.deleted_at')->where('compositions.members', 'like', '%"'.$id.'"%')->get();
		return $value;
	}




}