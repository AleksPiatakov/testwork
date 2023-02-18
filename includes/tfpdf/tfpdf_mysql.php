<?php
ini_set('memory_limit', '1024M');

require('tfpdf.php');

class PDF_MySQL_Table extends TFPDF
{
    var $ProcessingTable=false;
    var $aCols=array();
    var $TableX;
    var $HeaderColor;
    var $RowColors;
    var $ColorIndex;

    function Header()
    {
        //Print the table header if necessary

        //Title
        $this->SetFont('Arial','',10);
        $this->Cell(0,6,STORE_NAME,0,1,'C');
        // $this->SetX(80);
        //  $this->Cell(0,6,$this->Image(DIR_FS_CATALOG.'/content/ckfinder/images/ranita-logo-yumax.png',$this->GetX(),$this->GetY()-5, (300/25)*4, (95/25)*4),0,1,'C');
        $this->Ln(10);
        //Ensure table header is output
        parent::Header();

        if($this->ProcessingTable)
            $this->TableHeader();
    }

    function TableHeader()
    {
        //  $this->SetFont('Arial','B',12);
        $this->SetX($this->TableX);
        $fill=!empty($this->HeaderColor);
        if($fill)
            $this->SetFillColor($this->HeaderColor[0],$this->HeaderColor[1],$this->HeaderColor[2]);
        foreach($this->aCols as $col) {
            if($col['c']=='') $this->Cell($col['w'],6,$col['c'],0,0,'C',false); // если первая пустая колонка то бордера нет
            else $this->Cell($col['w'],6,$col['c'],0,0,'C',$fill);
        }
        $this->Ln();
    }

    function Row($data)
    {
        global $spec_array, $salemakers_array;
        $id = $data['products_id'];
        $this->SetX($this->TableX);
        $ci=$this->ColorIndex;
        $fill=!empty($this->RowColors[$ci]);
        if($fill)
            $this->SetFillColor($this->RowColors[$ci][0],$this->RowColors[$ci][1],$this->RowColors[$ci][2]);
        $cols_sum=0;
        $height = 0;
        foreach($this->aCols as $col) {
            if($cols_sum==0) $this->Cell($col['w'],20,'',0,0,$col['a'],$fill); // фикс бага со слетанием картинки внизу
            elseif($cols_sum==1) {
                $products_image = explode(';', $data['products_image'])[0];
                $products_image_path = "images/products/".$products_image;
                $height = 20;
                if( !is_file(DIR_FS_CATALOG.'/'.$products_image_path)) {
                    $products_image_path = "images/default.png";
                }
                else{
                    $imageSize = getimagesize($products_image_path);
                    $hToW = $imageSize[1]/$imageSize[0];
                    $height = $hToW*20;
                }

                if ($height < 5) $height = 8;
                $serHeight = round(strlen($data['products_name']) / 66) * 5;
                if ($serHeight > $height) {
                    $height = $serHeight;
                }

                $this->Cell($col['w'],$height,$this->ShowImage('18',DIR_FS_CATALOG.'/'.$products_image_path,$this->GetX()+2,$this->GetY()+2), 0, 0, $col['a'], false ); // HTTP_SERVER

            } elseif($cols_sum==2) {
                $this->Cell($col['w'],$height,'#'.$data['products_model'],0,0,$col['a'],$fill);
            } elseif($cols_sum==3) {
                $current_y = $this->GetY();
                $current_x = $this->GetX();

                // calc number of lines:
                if(strlen($data['products_name'])<=70) $string_height = $height;
                elseif(strlen($data['products_name'])<=95) $string_height = 10;
                else $string_height = 5;

                $this->MultiCell($col['w'], $string_height, $data['products_name'],0, $col['a'], $fill);
                $this->SetXY($current_x + $col['w'], $current_y);
                $current_x = $this->GetX();
            } elseif($cols_sum==4) {
                // special prices:
                if ($data['specials_new_products_price']) $spec_price = $data['specials_new_products_price'];
                elseif($spec_array[$id]) $spec_price = $spec_array[$id];
                elseif($salemakers_array[$id]) $spec_price = $salemakers_array[$id];
                else $spec_price = '';
                // price:
                if ($spec_price!='') {
                    $this->Cell(25,$height,$this->display_price($spec_price, $data['products_tax_class_id']),0,0,'L',$fill);
                    $this->Cell(5,$height,'('.$this->display_price($data['products_price'], $data['products_tax_class_id']).')',0,0,$col['a'],$fill);
                } else {
                    $this->Cell($col['w'],$height,$this->display_price($data['products_price'], $data['products_tax_class_id']),0,0,$col['a'],$fill);
                }
            }
            $cols_sum++;
        }

        $this->Ln();
        $this->ColorIndex=1-$ci;
    }

    function display_price($pprice, $ptax) {
        global $currencies;
        return strip_tags($currencies->display_price($pprice, $ptax));
    }

    function CalcWidths($width,$align)
    {
        //Compute the widths of the columns
        $TableWidth=0;
        foreach($this->aCols as $i=>$col)
        {
            $w=$col['w'];
            if($w==-1)
                $w=$width/count($this->aCols);
            elseif(substr($w,-1)=='%')
                $w=$w/100*$width;
            $this->aCols[$i]['w']=$w;
            $TableWidth+=$w;
        }
        //Compute the abscissa of the table
        if($align=='C')
            $this->TableX=max(($this->w-$TableWidth)/2,0);
        elseif($align=='R')
            $this->TableX=max($this->w-$this->rMargin-$TableWidth,0);
        else
            $this->TableX=$this->lMargin;
    }

    function AddCol($field=-1,$width=-1,$caption='',$align='L')
    {
        //Add a column to the table
        if($field==-1)
            $field=count($this->aCols);
        $this->aCols[]=array('f'=>$field,'c'=>$caption,'w'=>$width,'a'=>$align);
    }

    function Table($query,$prop=array())
    {
        $this->AddPage();

        $this->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
        $this->SetFont('DejaVu','',10);
        //Issue query
        $res=tep_db_query($query) or die('Error: '.mysql_error()."<BR>Query: $query");
        //Add all columns if none was specified

        $this->AddCol(); // фикс бага со слетанием картинки внизу
        $this->aCols[0]['c'] = '';
        $this->aCols[0]['w'] = '1';

        $this->AddCol();
        $this->aCols[1]['c'] = 'Image';
        $this->aCols[1]['w'] = '20';

        $this->AddCol();
        $this->aCols[2]['c'] = 'model';
        $this->aCols[2]['w'] = '30';

        $this->AddCol();
        $this->aCols[3]['c'] = 'Name';
        $this->aCols[3]['w'] = '80';

        $this->AddCol();
        $this->aCols[4]['c'] = 'Price';
        $this->aCols[4]['w'] = '30';
        $this->aCols[4]['a'] = 'C';

        //Handle properties
        if(!isset($prop['width']))
            $prop['width']=0;
        if($prop['width']==0)
            $prop['width']=$this->w-$this->lMargin-$this->rMargin;
        if(!isset($prop['align']))
            $prop['align']='C';
        if(!isset($prop['padding']))
            $prop['padding']=$this->cMargin;
        $cMargin=$this->cMargin;
        $this->cMargin=$prop['padding'];
        if(!isset($prop['HeaderColor']))
            $prop['HeaderColor']=array();
        $this->HeaderColor=$prop['HeaderColor'];
        if(!isset($prop['color1']))
            $prop['color1']=array();
        if(!isset($prop['color2']))
            $prop['color2']=array();
        $this->RowColors=array($prop['color1'],$prop['color2']);
        //Compute column widths
        $this->CalcWidths($prop['width'],$prop['align']);
        //Print header
        $this->TableHeader();
        //Print rows
        //  $this->SetFont('Arial','',11);
        $this->ColorIndex=0;
        $this->ProcessingTable=true;

        while($row=tep_db_fetch_array($res)) {
            $this->Row($row);
        }

        $this->ProcessingTable=false;
        $this->cMargin=$cMargin;
        $this->aCols=array();
    }

    function ShowImage($cell_width,$path,$imx,$imy)
    {
        //if(file_exists($path)) {
        $destination = DIR_FS_CATALOG."temp/";

        $size = @getimagesize($path);
        $array=explode("/", $path);
        $last=sizeof($array);

        $width = $size[0];
        $height = $size[1];

        if($width!=0) $cell_height = $height*$cell_width/$width;

        $image_format = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        if($size[2]==2) $src=imagecreatefromjpeg($path);
        elseif ($size[2]==3) $src=imagecreatefrompng($path);

        if($src!='') {
            $dimg = imagecreatetruecolor($width, $height);
            imagealphablending($dimg, false); // красивая прозрачность для временной картинки
            imagesavealpha($dimg, true);
            $background = imagecolorallocate($dimg, 0, 0, 0);
            ImageColorTransparent($dimg, $background);
            imagecopyresized($dimg, $src, 0, 0, 0, 0,$width, $height, $width, $height);
            //  $dimg = $src;

            $path = $destination . $array[$last-1];
            if (file_exists($path)) {
                $path = $destination . microtime() . '.' . $image_format;
            }

            if ($size[2]==2) {
                imagejpeg($dimg, $path,85);
            } elseif ($size[2]==3) {
                imagepng($dimg, $path);
            }

            if ($size[2]==3 and $image_format!='png') {}
            else $this->Image($path,$imx, $imy, $cell_width, $cell_height);

            if(file_exists($path)) unlink($path);
        }
        // }
    }

}
