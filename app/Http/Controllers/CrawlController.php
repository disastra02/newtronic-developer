<?php

namespace App\Http\Controllers;

use App\Models\CrawlData;
use Exception;
use Goutte\Client;
use Illuminate\Http\Request;

class CrawlController extends Controller
{
    public function index()
    {
        $data['crawl'] = CrawlData::get();
        return view('crawl.index', $data);
    }

    public function dataJson()
    {
        $data = CrawlData::get();

        return response()->json([
            'status' => true,
            'message' => 'Crawl Data',
            'data' => $data
        ]);
    }

    public function crawl()
    {
        try {
            $client = new Client();
            $url = 'https://www.smartdeal.co.id/rates/dki_banten';
            $crawler = $client->request('GET', $url);
    
            // Mengkosongkan data terlebih dahulu
            CrawlData::truncate();
    
            $crawler->filter('table tr.body')->each(function ($row) use (&$data) {
                $columns = $row->filter('td')->each(function ($column) {
                    return trim($column->text());
                });
    
                if (count($columns) >= 4) {
                    CrawlData::create([
                        'currency' => $columns[0], // Mata uang
                        'denomination' => $columns[1], // Denominasi
                        'buy_rate' => floatval($columns[2]), // Kurs Beli
                        'sell_rate' => floatval($columns[3]), // Kurs Jual
                    ]);
                }
            });

            return redirect()->back()->with('success', 'Berhasil crawl data');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan : '. $e->getMessage());
        }
    }
}
