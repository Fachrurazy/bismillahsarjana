<?php

namespace App\Http\Controllers;

use App\Dijkstra;
use App\Estimation;
use Illuminate\Http\Request;
use SplPriorityQueue;

class PriorityQueue extends SplPriorityQueue
{
    public function compare( $priority1, $priority2 )
    {
        if ($priority1 === $priority2) return 0;
        return $priority1 < $priority2 ? 1 : -1;
    }
}

class Graph
{
  private $verticies;

	function __construct()
	{
		$this->verticies = array();
	}

	public function add_vertex( $name, $edges )
	{
		$this->verticies[ $name ] = $edges;
	}

	public function shortest_path( $start, $finish )
	{
		$distances = array();
		$previous = array();
		$nodes = new SplPriorityQueue();

		foreach ( $this->verticies AS $vertex => $value )
		{
			if ( $vertex === $start )
			{
				$distances[ $vertex ] = 0;
				$nodes->insert( $vertex, 0 );
			}
			else
			{
				$distances[ $vertex ] = PHP_INT_MAX;
				$nodes->insert( $vertex, PHP_INT_MAX );
			}
			$previous[ $vertex ] = null;
		}

		$nodes->top();
		while ( $nodes->valid() )
		{
			$smallest = $nodes->current();

			if ( $smallest === $finish )
			{
				$path = array();
				while ( $previous[ $smallest ] )
				{
					$path[] = $smallest;
					$smallest = $previous[ $smallest ];
				}
				$path[] = $start;

				return array_reverse( $path );
			}

			if ( $smallest === null || $distances[ $smallest ] === PHP_INT_MAX )
			{
				break;
			}

			foreach ( $this->verticies[ $smallest ] AS $neighbor => $value )
			{
				$alt = $distances[ $smallest ] + $this->verticies[ $smallest ][ $neighbor ];
				if ( $alt < $distances[ $neighbor ] )
				{
					$distances[ $neighbor ] = $alt;
					$previous[ $neighbor ] = $smallest;
					$nodes->insert( $neighbor, $alt );

				}
			}

			$nodes->next();
		}

		return $distances;
	}

	public function __toString()
	{
		return print_r( $this->verticies, true );
	}
}

class DijkstraController extends Controller
{
    
    public function index()
    {
        $datas = Dijkstra::all();
        return view('dijkstra.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $estimate = new Estimation();
        $origin = $request->origin;
        $destination = $request->destination;
        // $print = [$origin, $destination];
        // echo $print;die();
        
        // echo strval($origin);
        // echo $destination;

        $graph = new Graph();
        $graph->add_vertex( 'Cikaret', array( 'Jatijajar' => 10511, 'Cilodong' => 3781, 'Citayam' => 8118, 'Karadenan' => 10181 ) );
        $graph->add_vertex( 'Jatijajar', array( 'Cikaret' => 10511, 'Cilodong' => 7889, 'Babakanmadang' => 22707 ) );
        $graph->add_vertex( 'Cilodong', array( 'Jatijajar' => 7889, 'Cikaret' => 3781, 'Citayam' => 10263 ) );
        $graph->add_vertex( 'Citayam', array( 'Cikaret' => 8118, 'Cilodong' => 10263, 'Karadenan' => 8339 ) );
        $graph->add_vertex( 'Karadenan', array( 'Cikaret' => 1081, 'Citayam' => 8339, 'Babakanmadang' => 12102  ) );
        $graph->add_vertex( 'Babakanmadang', array( 'Karadenan' => 12102, 'Jatijajar' => 22707) );
        
        print_r($graph->shortest_path('Cikaret', 'Karadenan'));
        // return response($graph->shortest_path('Cikaret', 'Babakanmadang'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dijkstra  $dijkstra
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
       
        // $estimate->save();
        // return redirect('/maps/index')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dijkstra  $dijkstra
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dijkstra  $dijkstra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dijkstra $dijkstra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dijkstra  $dijkstra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dijkstra $dijkstra)
    {
        //
    }

    
}
