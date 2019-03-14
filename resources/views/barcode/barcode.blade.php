@extends('layouts.admin')

@section('contenido')
    <div>

        {!! DNS2D::getBarcodeHTML("Hola maria jose linda", "QRCODE") !!}

    </div>
    <div>

        {!! DNS1D::getBarcodeSVG("1000547874", "C39") !!}

    </div>
    <div>
       {!! DNS2D::getBarcodeSVG("4445645656", "DATAMATRIX") !!}
    </div>

    echo DNS1D::getBarcodeSVG("4445645656", "PHARMA2T");
echo DNS1D::getBarcodeHTML("4445645656", "PHARMA2T");
echo '<img src="data:image/png,' . DNS1D::getBarcodePNG("4", "C39+") . '" alt="barcode"   />';
echo DNS1D::getBarcodePNGPath("4445645656", "PHARMA2T");
echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("4", "C39+") . '" alt="barcode"   />';
echo DNS1D::getBarcodeSVG("4445645656", "C39");
echo DNS2D::getBarcodeHTML("4445645656", "QRCODE");
echo DNS2D::getBarcodePNGPath("4445645656", "PDF417");
echo DNS2D::getBarcodeSVG("4445645656", "DATAMATRIX");
echo '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG("4", "PDF417") . '" alt="barcode"   />';
Width and Height example
echo DNS1D::getBarcodeSVG("4445645656", "PHARMA2T",3,33);
echo DNS1D::getBarcodeHTML("4445645656", "PHARMA2T",3,33);
echo '<img src="' . DNS1D::getBarcodePNG("4", "C39+",3,33) . '" alt="barcode"   />';
echo DNS1D::getBarcodePNGPath("4445645656", "PHARMA2T",3,33);
echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("4", "C39+",3,33) . '" alt="barcode"   />';
Color
echo DNS1D::getBarcodeSVG("4445645656", "PHARMA2T",3,33,"green");
echo DNS1D::getBarcodeHTML("4445645656", "PHARMA2T",3,33,"green");
echo '<img src="' . DNS1D::getBarcodePNG("4", "C39+",3,33,array(1,1,1)) . '" alt="barcode"   />';
echo DNS1D::getBarcodePNGPath("4445645656", "PHARMA2T",3,33,array(255,255,0));
echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("4", "C39+",3,33,array(1,1,1)) . '" alt="barcode"   />';
Show Text
echo DNS1D::getBarcodeSVG("4445645656", "PHARMA2T",3,33,"green", true);
echo DNS1D::getBarcodeHTML("4445645656", "PHARMA2T",3,33,"green", true);
echo '<img src="' . DNS1D::getBarcodePNG("4", "C39+",3,33,array(1,1,1), true) . '" alt="barcode"   />';
echo DNS1D::getBarcodePNGPath("4445645656", "PHARMA2T",3,33,array(255,255,0), true);
echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("4", "C39+",3,33,array(1,1,1), true) . '" alt="barcode"   />';
2D Barcodes
echo DNS2D::getBarcodeHTML("4445645656", "QRCODE");
echo DNS2D::getBarcodePNGPath("4445645656", "PDF417");
echo DNS2D::getBarcodeSVG("4445645656", "DATAMATRIX");
1D Barcodes
echo DNS1D::getBarcodeHTML("4445645656", "C39");
echo DNS1D::getBarcodeHTML("4445645656", "C39+");
echo DNS1D::getBarcodeHTML("4445645656", "C39E");
echo DNS1D::getBarcodeHTML("4445645656", "C39E+");
echo DNS1D::getBarcodeHTML("4445645656", "C93");
echo DNS1D::getBarcodeHTML("4445645656", "S25");
echo DNS1D::getBarcodeHTML("4445645656", "S25+");
echo DNS1D::getBarcodeHTML("4445645656", "I25");
echo DNS1D::getBarcodeHTML("4445645656", "I25+");
echo DNS1D::getBarcodeHTML("4445645656", "C128");
echo DNS1D::getBarcodeHTML("4445645656", "C128A");
echo DNS1D::getBarcodeHTML("4445645656", "C128B");
echo DNS1D::getBarcodeHTML("4445645656", "C128C");
echo DNS1D::getBarcodeHTML("44455656", "EAN2");
echo DNS1D::getBarcodeHTML("4445656", "EAN5");
echo DNS1D::getBarcodeHTML("4445", "EAN8");
echo DNS1D::getBarcodeHTML("4445", "EAN13");
echo DNS1D::getBarcodeHTML("4445645656", "UPCA");
echo DNS1D::getBarcodeHTML("4445645656", "UPCE");
echo DNS1D::getBarcodeHTML("4445645656", "MSI");
echo DNS1D::getBarcodeHTML("4445645656", "MSI+");
echo DNS1D::getBarcodeHTML("4445645656", "POSTNET");
echo DNS1D::getBarcodeHTML("4445645656", "PLANET");
echo DNS1D::getBarcodeHTML("4445645656", "RMS4CC");
echo DNS1D::getBarcodeHTML("4445645656", "KIX");
echo DNS1D::getBarcodeHTML("4445645656", "IMB");
echo DNS1D::getBarcodeHTML("4445645656", "CODABAR");
echo DNS1D::getBarcodeHTML("4445645656", "CODE11");
echo DNS1D::getBarcodeHTML("4445645656", "PHARMA");
echo DNS1D::getBarcodeHTML("4445645656", "PHARMA2T");
@endsection