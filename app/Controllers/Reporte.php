<?php

namespace App\Controllers;

use FPDF;
use easyTable;
use exFPDF;

class Reporte extends exFPDF
{

    public function __construct()
    {
        parent::__construct('P', 'mm', 'Letter');
    }

    public function planilla()
    {
        $this->cabeceraAsistencia();
        $this->cuerpoAsistenciaNormal();
        // $this->cuerpoAsistenciaSeguridad();
        $this->Output();
    }
    public function cabeceraAsistencia()
    {
        $this->AddPage();
        $this->setSourceFile(APPPATH . "Controllers/plantillaPlanillaRegularizacion.pdf");
        $tplIdx = $this->importPage(1);
        $this->useTemplate($tplIdx, 0, -5, 218);
        $this->Ln(27);
        $this->SetFont('times', 'BU', 16);
        $this->Cell(0, 10, 'PLANILLA DE ASISTENCIA DIARIA', 0, 1, 'C');
        $table = new easyTable($this, '{26, 70, 20, 50}', 'border:0; font-size:10;');
        $table->easyCell(utf8_decode('NOMBRE:'));
        $table->easyCell(utf8_decode('DAVID CALLISAYA QUISPE'), 'font-style:');
        $table->easyCell(utf8_decode('C.I.:'));
        $table->easyCell(utf8_decode('10918815'), 'font-style:');
        $table->printRow();
        $table->easyCell(utf8_decode('ASISTENCIA:'));
        $table->easyCell(utf8_decode('01-12-2022 AL 14-12-2022'), 'font-style:');
        $table->easyCell(utf8_decode('CODIGO:'));
        $table->easyCell(utf8_decode('1150'), 'font-style:');
        $table->printRow();
        $table->easyCell(utf8_decode('CARGO:'));
        $table->easyCell(utf8_decode('AUXILIAR DE OFICINA'), 'font-style:');
        $table->printRow();
        $table->easyCell(utf8_decode('UNIDAD:'));
        $table->easyCell(utf8_decode('UNIDAD DE TELEVISIÓN UNIVERSITARIA UNIDAD DE TELEVISIÓN UNIVERSITARIA'), 'font-style:; colspan:3');
        $table->printRow();
        $table->endTable();
    }

    public function cuerpoAsistenciaNormal()
    {
        $this->Ln(5);
        $table = new easyTable($this, '{20, 15, 30, 13, 30, 15, 30, 13, 30}', 'border:1; font-size:10; align:{C,C,C,C,C,C,C,C,C}');
        $table->easyCell(utf8_decode('Fecha'), 'rowspan:2');
        $table->easyCell(utf8_decode('Mañana'), 'colspan:4; align:C');
        $table->easyCell(utf8_decode('Tarde'), 'colspan:4; align:C');
        $table->printRow();
        $table->easyCell(utf8_decode('Ingreso'), 'align:C');
        $table->easyCell(utf8_decode('Firma'), 'align:C');
        $table->easyCell(utf8_decode('Salida'), 'align:C');
        $table->easyCell(utf8_decode('Firma'), 'align:C');
        $table->easyCell(utf8_decode('Ingreso'), 'align:C');
        $table->easyCell(utf8_decode('Firma'), 'align:C');
        $table->easyCell(utf8_decode('Salida'), 'align:C');
        $table->easyCell(utf8_decode('Firma'), 'align:C');
        $table->printRow();

        for ($i = 1; $i <= 14; $i++) {
            $table->rowStyle('min-height:10; valign:M');
            $table->easyCell(utf8_decode("{$i}-12-2022"), 'align:C');
            $table->easyCell(utf8_decode('08:00'), 'align:C');
            $table->easyCell(utf8_decode(''), 'align:C');
            $table->easyCell(utf8_decode('12:00'), 'align:C');
            $table->easyCell(utf8_decode(''), 'align:C');
            $table->easyCell(utf8_decode('13:00'), 'align:C');
            $table->easyCell(utf8_decode(''), 'align:C');
            $table->easyCell(utf8_decode('16:00'), 'align:C');
            $table->easyCell(utf8_decode(''), 'align:C');
            $table->printRow();
        }
    }

    public function cuerpoAsistenciaSeguridad()
    {
        $this->Ln(5);
        $table = new easyTable($this, '{25, 22, 45, 22, 45}', 'border:1; font-size:10; align:{C,C,C,C,C,C,C,C,C}');
        $table->easyCell(utf8_decode('Fecha'), 'align:C');
        $table->easyCell(utf8_decode('Ingreso'), 'align:C');
        $table->easyCell(utf8_decode('Firma'), 'align:C');
        $table->easyCell(utf8_decode('Salida'), 'align:C');
        $table->easyCell(utf8_decode('Firma'), 'align:C');
        $table->printRow();

        for ($i = 1; $i <= 14; $i++) {
            $table->rowStyle('min-height:10; valign:M');
            $table->easyCell(utf8_decode("{$i}-12-2022"), 'align:C');
            $table->easyCell(utf8_decode(''), 'align:C');
            $table->easyCell(utf8_decode(''), 'align:C');
            $table->easyCell(utf8_decode(''), 'align:C');
            $table->easyCell(utf8_decode(''), 'align:C');

            $table->printRow();
        }
    }

    public function reporte()
    {
        // $pdf = new FPDF();

        $pdf = new FPDF('L', 'mm', 'Letter');
        $pageCount = $pdf->setSourceFile('plantillaPlanillaRegularizacion.pdf');
        $pageId = $pdf->importPage(1, PageBoundaries::MEDIA_BOX);

        $pdf->addPage();
        $pdf->useImportedPage($pageId, 10, 10, 90);

        $data = array(
            array('id' => 1, 'nombre' => 'Callisaya Quispe David', 'ci' => '10918815 LP', 'cargo' => 'AUXILIAR DE OFICINA'),
            array('id' => 1, 'nombre' => 'Callisaya Quispe David', 'ci' => '10918815 LP', 'cargo' => 'AUXILIAR DE OFICINA'),
            array('id' => 1, 'nombre' => 'Callisaya Quispe David', 'ci' => '10918815 LP', 'cargo' => 'AUXILIAR DE OFICINA'),
            array('id' => 1, 'nombre' => 'Callisaya Quispe David', 'ci' => '10918815 LP', 'cargo' => 'AUXILIAR DE OFICINA'),
            array('id' => 1, 'nombre' => 'Callisaya Quispe David', 'ci' => '10918815 LP', 'cargo' => 'AUXILIAR DE OFICINA'),
        );
        $pdf->AddPage();
        $pdf->setXY(0, 10);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(7);
        $pdf->SetTextColor(88, 88, 88);

        // $pdf->AddFont('Calibri', 'B', 'calibri.php');
        $pdf->SetFont('Arial', '', 18.5);
        $pdf->Cell(0, 6, utf8_decode('Universidad Pública de El Alto'), 0, 1, 'C');
        // $pdf->Cell(w, h, 'text', (0 or 1), (0 or 1 or 2), (L or C or R));

        $pdf->Ln(0.1);
        $pdf->SetFontSize(7.5);
        $pdf->Cell(0, 5, 'Creada por ley 2115 del 5 de Septiembre de 2000 y Autonoma por ley 2556 del 12 de Noviembre de 2003', 0, 0, 'C', false);
        $pdf->Ln(4.5);
        $pdf->Cell(0, 5, utf8_decode('Sistema de Administración y Control de Planillas "SiACoP"'), 0, 0, 'C', false);
        // controller path

        // $pdf->Image('http://localhost:8080/img/rrhh.png', 240, 15, 33, 10);
        // $pdf->Image(base_url('img/upea.jpg'), 30, 14, 18, 18);

        $pdf->SetLineWidth(0.8);
        $pdf->Line(11, 27, 29, 27);
        $pdf->Line(48, 27, 280, 27);

        $pdf->SetFont('Times', 'B', 13.5);
        $pdf->Ln(7);
        $pdf->Cell(0, 6, 'PLANILLA DE ASISTENCIA DIARIA', 0, 0, 'C');

        $pdf->SetLineWidth(0.6);
        $pdf->SetDrawColor(88, 88, 88);
        $pdf->Line(109.5, 33, 190.5, 33);

        $pdf->Ln();

        $pdf->SetFontSize(9);
        $pdf->SetLineWidth(0.2);
        $pdf->Cell(80, 5, utf8_decode('UNIDAD DE TELEVISIÓN UNIVERSITARIA'), 0, 0, 'L');
        $pdf->Line(11.5, 37.5, 76, 37.5);
        $pdf->Cell(182, 5, 'GESTION:', 0, 0, 'R');

        $pdf->SetFont('Times', '', 9);
        $pdf->Cell(8, 5, '2022', 0, 0, 'R');

        $pdf->Ln(7);

        $pdf->SetFont('Times', 'B', 10);

        $pdf->SetFillColor(255, 255, 255);


        $p = 0;
        $q = 0;

        foreach ($data as $key => $value) {
            $pdf->SetLineWidth(0.2);
            $pdf->Cell(110, 5, 'FECHA:', 1, 0, 'L', 1, false);
            $pdf->Cell(80, 5, utf8_decode('MAÑANA'), 1, 0, 'C', 1, false);
            $pdf->Cell(80, 5, 'TARDE', 1, 0, 'C', 1);
            $pdf->Ln();

            $pdf->SetFillColor(251, 227, 213);

            $pdf->SetFontSize(6.5);
            $pdf->Cell(10, 5, utf8_decode('N°'), 1, 0, 'L', 1);
            $pdf->Cell(45, 5, 'APELLIDOS Y NOMBRES', 1, 0, 'C', 1);
            $pdf->Cell(20, 5, 'CI', 1, 0, 'C', 1);
            $pdf->Cell(35, 5, 'Cargo', 1, 0, 'C', 1);

            $pdf->Multicell(13, 2.5, "HORA INGRESO", 1, 'C', true);
            $pdf->SetY(45.6 + $p);
            $pdf->SetX(133);
            $pdf->Cell(27, 5, 'FIRMA', 1, 0, 'C', 1);
            $pdf->Multicell(13, 2.5, "HORA SALIDA", 1, 'C', true);
            $pdf->SetY(45.6 + $p);
            $pdf->SetX(173);
            $pdf->Cell(27, 5, 'FIRMA', 1, 0, 'C', 1);

            $pdf->Multicell(13, 2.5, "HORA \nINGRESO", 1, 'C', true);
            $pdf->SetY(45.6 + $p);
            $pdf->SetX(213);
            $pdf->Cell(27, 5, 'FIRMA', 1, 0, 'C', 1);
            $pdf->Multicell(13, 2.5, "HORA SALIDA", 1, 'C', true);
            $pdf->SetY(45.6 + $p);
            $pdf->SetX(253);
            $pdf->Cell(27, 5, 'FIRMA', 1, 0, 'C', 1);
            $pdf->Ln();

            $pdf->SetFillColor(255, 255, 255);

            $pdf->SetFontSize(8);
            $pdf->Cell(10, 10, $value['id'], 1, 0, 'C', 1);
            $pdf->Cell(45, 10, $value['nombre'], 1, 0, 'C', 1);
            $pdf->Cell(20, 10, $value['ci'], 1, 0, 'C', 1);
            $pdf->Cell(35, 10, $value['cargo'], 1, 0, 'C', 1);

            $pdf->cell(13, 10, "8:00", 1, 0, 'C', 1);
            $pdf->Cell(27, 10, '', 1, 0, 'C', 1);
            $pdf->Cell(13, 10, "12:00", 1, 0, 'C', 1);
            $pdf->Cell(27, 10, '', 1, 0, 'C', 1);

            $pdf->Cell(13, 10, "13:00", 1, 0, 'C', 1);
            $pdf->Cell(27, 10, '', 1, 0, 'C', 1);
            $pdf->Cell(13, 10, "16:00", 1, 0, 'C', 1);
            $pdf->Cell(27, 10, '', 1, 0, 'C', 1);
            $pdf->Ln(12);

            $p += 22;

            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetLineWidth(1);
            $pdf->Line(120, 41 + $q, 120, 60 + $q);
            $pdf->Line(200, 41 + $q, 200, 60 + $q);
            $pdf->SetLineWidth(1.2);
            $pdf->Line(280, 41 + $q, 280, 60 + $q);
            $q += 22;
        }
        $pdf->Ln(28);

        $pdf->SetLineWidth(0.2);
        $pdf->SetDrawColor(88, 88, 88);
        $pdf->Line(43, 177, 115, 177);
        $pdf->Line(175, 177, 250, 177);

        $pdf->Cell(135, 3, utf8_decode('VºBº INMEDIATO SUPERIOR'), 0, 0, 'C', 1);
        $pdf->Cell(135, 3, utf8_decode('VºBº RECURSOS HUMANOS'), 0, 0, 'C', 1);

        $pdf->Output();
    }
}
