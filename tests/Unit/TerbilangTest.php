<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Helpers\Terbilang;

class TerbilangTest extends TestCase
{
    /**
     * Test basic numbers
     */
    public function test_basic_numbers(): void
    {
        $this->assertEquals('Nol Rupiah', Terbilang::rupiah(0));
        $this->assertEquals('Satu Rupiah', Terbilang::rupiah(1));
        $this->assertEquals('Sepuluh Rupiah', Terbilang::rupiah(10));
        $this->assertEquals('Sebelas Rupiah', Terbilang::rupiah(11));
    }

    /**
     * Test teens
     */
    public function test_teens(): void
    {
        $this->assertEquals('Dua Belas Rupiah', Terbilang::rupiah(12));
        $this->assertEquals('Lima Belas Rupiah', Terbilang::rupiah(15));
        $this->assertEquals('Sembilan Belas Rupiah', Terbilang::rupiah(19));
    }

    /**
     * Test tens
     */
    public function test_tens(): void
    {
        $this->assertEquals('Dua Puluh Rupiah', Terbilang::rupiah(20));
        $this->assertEquals('Tiga Puluh Lima Rupiah', Terbilang::rupiah(35));
        $this->assertEquals('Sembilan Puluh Sembilan Rupiah', Terbilang::rupiah(99));
    }

    /**
     * Test hundreds
     */
    public function test_hundreds(): void
    {
        $this->assertEquals('Seratus Rupiah', Terbilang::rupiah(100));
        $this->assertEquals('Dua Ratus Lima Puluh Rupiah', Terbilang::rupiah(250));
        $this->assertEquals('Sembilan Ratus Sembilan Puluh Sembilan Rupiah', Terbilang::rupiah(999));
    }

    /**
     * Test thousands
     */
    public function test_thousands(): void
    {
        $this->assertEquals('Seribu Rupiah', Terbilang::rupiah(1000));
        $this->assertEquals('Lima Ribu Rupiah', Terbilang::rupiah(5000));
        $this->assertEquals('Sepuluh Ribu Rupiah', Terbilang::rupiah(10000));
    }

    /**
     * Test millions
     */
    public function test_millions(): void
    {
        $this->assertEquals('Satu Juta Rupiah', Terbilang::rupiah(1000000));
        $this->assertEquals('Dua Juta Lima Ratus Ribu Rupiah', Terbilang::rupiah(2500000));
        $this->assertEquals('Lima Juta Rupiah', Terbilang::rupiah(5000000));
    }

    /**
     * Test complex numbers
     */
    public function test_complex_numbers(): void
    {
        $this->assertEquals(
            'Satu Juta Lima Ratus Ribu Rupiah',
            Terbilang::rupiah(1500000)
        );
        
        $this->assertEquals(
            'Tiga Juta Dua Ratus Lima Puluh Ribu Rupiah',
            Terbilang::rupiah(3250000)
        );
        
        $this->assertEquals(
            'Sepuluh Juta Seratus Dua Puluh Tiga Ribu Empat Ratus Lima Puluh Enam Rupiah',
            Terbilang::rupiah(10123456)
        );
    }

    /**
     * Test billions
     */
    public function test_billions(): void
    {
        $this->assertEquals('Satu Miliar Rupiah', Terbilang::rupiah(1000000000));
        $this->assertEquals(
            'Satu Miliar Lima Ratus Juta Rupiah',
            Terbilang::rupiah(1500000000)
        );
    }

    /**
     * Test helper function
     */
    public function test_helper_function(): void
    {
        $this->assertEquals('Seribu Rupiah', terbilang(1000));
        $this->assertEquals('Satu Juta Rupiah', terbilang(1000000));
    }
}
