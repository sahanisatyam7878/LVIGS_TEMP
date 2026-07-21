<?php

namespace Tests\Feature;

use Tests\TestCase;

class InvestmentFlowTest extends TestCase
{
    public function test_customer_can_complete_investment_flow_and_download_pdf(): void
    {
        config(['session.driver' => 'array']);

        $this->post('/investment/checkout', [
            'name' => 'Test Customer',
            'email' => 'customer@example.com',
            'phone' => '+91 98765 43210',
            'business_name' => 'Test Growth Store',
            'business_address' => 'Main Market Road',
            'city' => 'Patna',
            'state' => 'Bihar',
            'pincode' => '800001',
            'category' => 'Long Term Growth',
            'plan' => '10k',
            'message' => 'Need catalogue promotion.',
        ])->assertRedirect('/investment/payment')
            ->assertSessionHas('investment.pending');

        $this->get('/investment/payment')
            ->assertOk()
            ->assertSee('Confirm investment payment')
            ->assertSee('Test Growth Store')
            ->assertSee('Valid Until');

        $this->post('/investment/payment', [
            'payment_method' => 'UPI',
            'transaction_id' => 'UTR123456',
        ])->assertRedirect('/investment/success')
            ->assertSessionHas('investment.receipt');

        $this->get('/investment/success')
            ->assertOk()
            ->assertSee('Your investment PDF is ready')
            ->assertSee('UTR123456');

        $this->get('/investment/receipt.pdf')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/pdf')
            ->assertSee('%PDF-1.4', false);
    }
}
