<?php

namespace App\Http\Controllers;

use App\Models\Insight;
use App\Services\TikTokService;
use App\Services\InstagramService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InsightController extends Controller
{
    public function __construct(
        protected TikTokService $tiktokService,
        protected InstagramService $instagramService
    ) {}

    public function index(Request $request)
    {
        // Jika database kosong dan di environment local, generate dummy data otomatis
        if (config('app.env') === 'local' && Insight::count() === 0) {
            $this->generateDummyData(50);
        }

        $insights = Insight::filter($request->all())
            ->orderBy('date', 'desc')
            ->paginate(20);

        return view('insights.index', [
            'insights' => $insights,
            'filters' => $request->all()
        ]);
    }

    public function fetchFromApis()
    {
        try {
            // Fetch from TikTok
            $tiktokData = $this->generateDummyApiResponse('tiktok', 10);
            $this->storeInsights($tiktokData, 'tiktok');

            // Fetch from Instagram
            $instagramData = $this->generateDummyApiResponse('instagram', 10);
            $this->storeInsights($instagramData, 'instagram');

            return back()->with('success', '20 dummy insights berhasil di-generate (10 TikTok + 10 Instagram)');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: '.$e->getMessage());
        }
    }

    /**
     * Generate dummy data untuk development
     */
    public function generateDummyData(int $count = 50)
    {
        $platforms = ['tiktok', 'instagram'];
        $startDate = now()->subMonths(3);

        for ($i = 0; $i < $count; $i++) {
            $platform = $platforms[array_rand($platforms)];
            $date = $startDate->copy()->addDays(rand(0, 90));

            Insight::updateOrCreate(
                [
                    'platform' => $platform,
                    'post_id' => 'POST_' . rand(1000, 9999)
                ],
                [
                    'likes' => rand(1000, 500000),
                    'comments' => rand(50, 50000),
                    'shares' => rand(10, 10000),
                    'views' => $platform === 'tiktok' ? rand(10000, 5000000) : rand(1000, 100000),
                    'saves' => rand(50, 5000),
                    'date' => $date
                ]
            );
        }
    }

    /**
     * Simpan data insights ke database
     */
    protected function storeInsights(array $data, string $platform)
    {
        foreach ($data as $item) {
            Insight::updateOrCreate(
                ['platform' => $platform, 'post_id' => $item['post_id']],
                [
                    'likes' => $item['likes'],
                    'comments' => $item['comments'],
                    'shares' => $item['shares'],
                    'views' => $item['views'] ?? 0,
                    'saves' => $item['saves'] ?? 0,
                    'date' => $item['date']
                ]
            );
        }
    }

    /**
     * Generate dummy API response untuk simulasi
     */
    protected function generateDummyApiResponse(string $platform, int $count = 5): array
    {
        $data = [];
        $startDate = now()->subDays($count);

        for ($i = 0; $i < $count; $i++) {
            $data[] = [
                'post_id' => $platform.'_'.uniqid(),
                'likes' => $platform === 'tiktok' ? rand(10000, 500000) : rand(1000, 100000),
                'comments' => rand(50, 5000),
                'shares' => rand(10, 5000),
                'views' => $platform === 'tiktok' ? rand(50000, 5000000) : rand(5000, 100000),
                'saves' => rand(50, 5000),
                'date' => $startDate->copy()->addDays($i)
            ];
        }

        return $data;
    }

    /**
     * Route khusus untuk generate dummy data (akses via /insights/generate-dummy)
     */
    public function generateDummyDataEndpoint(Request $request)
    {
        $count = $request->input('count', 20);
        $this->generateDummyData($count);

        return back()->with('success', "{$count} dummy insights berhasil dibuat");
    }
}
