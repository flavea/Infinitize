<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\View;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

class ViewController extends Controller
{
	public $show_action = true;
	
	public function index()
	{
		$results = View::getInfo();
		return view('main', compact('results'));
	}
	
	public function insp()
	{
		$results = View::getInfo();
		return view('inspirit', compact('results'));
	}

	public function members()
	{
		$results = View::getMembers();
		return view('members', compact('results'));
	}

	public function news()
	{
		$results = View::getNews();
		return view('news', compact('results'));
	}

	public function subunits()
	{
		$results = View::getSubunits();
		return view('subunits', compact('results'));
	}

	public function discography()
	{
		
		$albums = View::getDiscography();
		$songs = View::getSongs();
		$types = View::getDisTypes();

		return view('discography', compact('albums', 'songs', 'types'));
	}

	public function drama()
	{
		
		$dramas = View::getDramas();
		$roles = View::getRoles();

		return view('drama', compact('dramas', 'roles'));
	}

	public function variety()
	{
		
		$varshows = View::getVarieties();
		$members = View::getMembers();

		return view('varshow', compact('varshows', 'members'));
	}

	public function concerts()
	{
		
		$concerts = View::getConcerts();

		return view('concerts', compact('concerts'));
	}

	public function songs()
	{
		$songs = View::getSongs();
		$albums = View::getDiscography();
		$members = View::getMembers();
		$mvs = View::getMVs();

		return view('songlist', compact('songs', 'albums', 'members', 'mvs'));
	}

	public function awards()
	{
		
		$awards = View::getAwards();
		$songs = View::getTitleSongs();
		$years = View::getAwardYears();

		return view('awards', compact('awards', 'songs', 'years'));
	}

	public function subunitdisco($id)
	{
		$data['id'] = $id;
		$albums = View::getSubunitDisco($data);
		$songs = View::getSongs();
		$types = View::getDisTypes();

		return view('discography', compact('albums', 'songs', 'types'));
	}

	public function albumid($id)
	{
		$data['id'] = $id;
		$albums = View::getAlbum($data);
		$songs = View::getAlbumSongs($id);
		$types = View::getDisTypes();
		$members = View::getMembers();
		$mv = View::getMVs();

		return view('album', compact('albums', 'songs', 'types', 'members', 'mv'));
	}



	public function dramadetail($id)
	{
		
		$data['id'] = $id;
		$dramas = View::getDramaDetail($data);
		$roles = View::getDramaRoles($data);
		$episodes = View::getDramaEpisodes($data);

		return view('dramadetail', compact('dramas', 'roles', 'episodes'));
	}

	public function varietydetail($id)
	{
		
		$data['id'] = $id;
		
		$varshows = View::getVarietyDetail($data);
		$episodes = View::getVarietyEpisodes($data);
		$members = View::getMembers();

		return view('varietydetail', compact('varshows', 'members', 'episodes'));
	}



	public function memberdetail($id)
	{
		
		$results = View::getMemberDetail($id);
		$dramas = View::getMemberDramas($id);
		$albums = View::getMemberAlbums($id);
		$songs = View::getMemberSongs($id);
		$varshows = View::getMemberVarshow($id);
		$compositions = View::getMemberCompositions($id);

		return view('member', compact('results', 'dramas', 'albums', 'songs', 'varshows', 'compositions'));
	}

	public function musicvideos()
	{
		
		$mvs = View::getMVs();
		return view('mv', compact('mvs'));
	}
}
