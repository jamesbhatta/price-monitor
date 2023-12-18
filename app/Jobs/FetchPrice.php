<?php

namespace App\Jobs;

use App\Models\Product;
use DOMDocument;
use DOMXPath;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class FetchPrice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Product $product
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = Http::get($this->product->url);

        if ($response->failed()) {
            return;
        }

        $pattern = '/"salePrice":{"text":"Rs\. [\d,]+","value":(\d+)}/';

        if (preg_match($pattern, $response->body(), $matches)) {
            $price = str_replace(',', '', $matches[1]);

            $this->product->prices()->create(['price' => $price]);
        }

        try {
            libxml_use_internal_errors(true);
            $dom = new DOMDocument();
            $dom->loadHTML($response->body());

            $xpath = new DOMXPath($dom);
            libxml_use_internal_errors(false);

            $query = '//meta[@name="og:image"]';
            $ogImageNode = $xpath->query($query)->item(0);

            if ($ogImageNode) {
                $image = $ogImageNode->getAttribute('content');
                if ($image) {
                    $this->product->update(['image' => $image]);
                }
            }
        } catch (\Throwable $th) {
            report($th);
        }
    }
}
