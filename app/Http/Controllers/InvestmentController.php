<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class InvestmentController extends Controller
{
    private const PLANS = [
        '10k' => [
            'name' => 'Starter Plan',
            'duration' => 'Rs. 10K Range',
            'amount' => 10000,
        ],
        '50k' => [
            'name' => 'Growth Plan',
            'duration' => 'Rs. 50K Range',
            'amount' => 50000,
        ],
        '1lakh' => [
            'name' => 'Business Plan',
            'duration' => 'Rs. 1 Lakh Range',
            'amount' => 100000,
        ],
        '5lakh' => [
            'name' => 'Premium Plan',
            'duration' => 'Rs. 5 Lakh Range',
            'amount' => 500000,
        ],
        '10lakh' => [
            'name' => 'Elite Plan',
            'duration' => 'Rs. 10 Lakh Range',
            'amount' => 1000000,
        ],
        '50lakh' => [
            'name' => 'Enterprise Plan',
            'duration' => 'Rs. 50 Lakh Range',
            'amount' => 5000000,
        ],
        '1cr' => [
            'name' => 'Legacy Plan',
            'duration' => 'Rs. 1 Crore Range',
            'amount' => 10000000,
        ],
    ];

    public function show(): View
    {
        return view('frontend.investment', [
            'plans' => self::PLANS,
            'settings' => InvestmentSettingsStore::get(),
        ]);
    }

    public function apply(): View
    {
        return view('frontend.investment-apply', [
            'plans' => self::PLANS,
            'investment' => request()->session()->get('investment.pending', []),
        ]);
    }

    public function checkout(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'phone' => ['required', 'string', 'max:20'],
            'business_name' => ['required', 'string', 'max:160'],
            'business_address' => ['required', 'string', 'max:240'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'pincode' => ['required', 'string', 'max:12'],
            'category' => ['required', 'string', 'max:100'],
            'plan' => ['required', 'in:10k,50k,1lakh,5lakh,10lakh,50lakh,1cr'],
            'message' => ['nullable', 'string', 'max:500'],
        ]);

        $startsOn = now();

        $data['plan_name'] = self::PLANS[$data['plan']]['name'];
        $data['duration'] = self::PLANS[$data['plan']]['duration'];
        $data['amount'] = self::PLANS[$data['plan']]['amount'];
        $data['application_id'] = 'LVIGS-'.now()->format('YmdHis');
        $data['applied_at'] = now()->format('d M Y, h:i A');
        $data['starts_on'] = $startsOn->format('d M Y');
        $data['valid_until'] = 'Plan based';

        $request->session()->put('investment.pending', $data);

        return redirect()->route('investment.payment');
    }

    public function payment(Request $request): View|RedirectResponse
    {
        $investment = $request->session()->get('investment.pending');

        if (! $investment) {
            return redirect()->route('investment.apply');
        }

        return view('frontend.investment-payment', compact('investment'));
    }

    public function completePayment(Request $request): RedirectResponse
    {
        $investment = $request->session()->get('investment.pending');

        if (! $investment) {
            return redirect()->route('investment.apply');
        }

        $data = $request->validate([
            'payment_method' => ['required', 'in:UPI,Card,Net Banking'],
            'transaction_id' => ['nullable', 'string', 'max:80'],
        ]);

        $investment['payment_method'] = $data['payment_method'];
        $investment['transaction_id'] = $data['transaction_id'] ?: 'TXN-'.now()->format('YmdHis');
        $investment['paid_at'] = now()->format('d M Y, h:i A');
        $investment['status'] = 'Paid';

        $request->session()->forget('investment.pending');
        $request->session()->put('investment.receipt', $investment);

        return redirect()->route('investment.success');
    }

    public function success(Request $request): View|RedirectResponse
    {
        $investment = $request->session()->get('investment.receipt');

        if (! $investment) {
            return redirect()->route('investment.apply');
        }

        return view('frontend.investment-success', compact('investment'));
    }

    public function receiptPdf(Request $request): Response|RedirectResponse
    {
        $investment = $request->session()->get('investment.receipt');

        if (! $investment) {
            return redirect()->route('investment.apply');
        }

        $pdf = $this->buildPdf($investment);

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.$investment['application_id'].'-investment-receipt.pdf"',
        ]);
    }

    private function buildPdf(array $investment): string
    {
        $lines = [
            'LVIGS MART Investment Receipt',
            'Application ID: '.$investment['application_id'],
            'Status: '.$investment['status'],
            'Investor Name: '.$investment['name'],
            'Email: '.$investment['email'],
            'Phone: '.$investment['phone'],
            'Investor / Company Name: '.$investment['business_name'],
            'Address: '.$investment['business_address'],
            'City: '.$investment['city'],
            'State: '.$investment['state'],
            'Pincode: '.$investment['pincode'],
            'Investment Focus: '.$investment['category'],
            'Selected Plan: '.$investment['plan_name'],
            'Duration: '.$investment['duration'],
            'Starts On: '.$investment['starts_on'],
            'Valid Until: '.$investment['valid_until'],
            'Amount Paid: Rs. '.number_format($investment['amount'], 0),
            'Payment Method: '.$investment['payment_method'],
            'Transaction ID: '.$investment['transaction_id'],
            'Paid At: '.$investment['paid_at'],
            'Note: This receipt confirms the selected LVIGS MART investment plan.',
        ];

        $content = "BT\n/F1 22 Tf\n72 760 Td\n(".$this->pdfText($lines[0]).") Tj\n";
        $content .= "/F1 12 Tf\n0 -34 Td\n";

        foreach (array_slice($lines, 1) as $line) {
            $content .= '('.$this->pdfText($line).") Tj\n0 -22 Td\n";
        }

        $content .= 'ET';

        $objects = [
            "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n",
            "2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n",
            "3 0 obj\n<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 4 0 R >> >> /Contents 5 0 R >>\nendobj\n",
            "4 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\n",
            "5 0 obj\n<< /Length ".strlen($content)." >>\nstream\n".$content."\nendstream\nendobj\n",
        ];

        $pdf = "%PDF-1.4\n";
        $offsets = [0];

        foreach ($objects as $object) {
            $offsets[] = strlen($pdf);
            $pdf .= $object;
        }

        $xref = strlen($pdf);
        $pdf .= "xref\n0 ".(count($objects) + 1)."\n";
        $pdf .= "0000000000 65535 f \n";

        foreach (array_slice($offsets, 1) as $offset) {
            $pdf .= sprintf("%010d 00000 n \n", $offset);
        }

        $pdf .= "trailer\n<< /Size ".(count($objects) + 1)." /Root 1 0 R >>\n";
        $pdf .= "startxref\n".$xref."\n%%EOF";

        return $pdf;
    }

    private function pdfText(string $text): string
    {
        return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $text);
    }
}
