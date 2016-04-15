<?php 
	//require("../ligacaoBD.php");
	

	session_start(); /* Starts the session */
	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
		exit;
	}

	require("../fpdf/tfpdf.php");


	$id = $_GET['id'];
	$descricao_a = $_GET['descricao_a']; 
	$descricao_e = $_GET['descricao_e'];
	/*$data_e = $_GET['data_e'];
	$data_s= $_GET['data_s';
	$estado = $_GET['estado'];
	$servico = $_GET['servico'];
	$produto = $_GET['produto'];
	$preco_total = $_GET['preco_total'];
	$cliente = $_GET['cliente'];
	$funcionario = $_GET['funcionario'];*/

	$titulo = "2016A_$id";
	
	$pdf= new TFPDF("P","pt","A4");
    
 
	$pdf->AddPage();
	//$pdf->Image('../imagens/logo.png');
	 


	/*$pdf->SetFont('Arial','B',16);
	$pdf->Cell(40,10,$titulo);
	$pdf->Output();*/

	// Add a Unicode font (uses UTF-8)
	$pdf->AddFont('DejaVu','','DejaVuSans.ttf',true);
	//$pdf->AddFont('aria','','arial.ttf',true);



	$pdf->SetFont('arial','B',18);
	$pdf->Cell(0,5,'Termos Gerais',0,1,'C');

	$pdf->SetFont('DejaVu','',9);
	$pdf->Cell(0,5,"","B",0,'C');
	$pdf->Cell(0,0,$titulo,0,1,'R');
	$pdf->Ln(8);
	
	$pdf->SetFont('DejaVu','',10);
	$pdf->MultiCell(500,10,'
		A reparação de equipamentos informáticos tem uma Garantia de 30 dias a contar da data da prestação do serviço, sendo a garantia válida apenas para as peças aplicadas, não incluindo situações tais como uso inadequado do material ou respectivos acessórios, perturbações atmosféricas e /ou eléctricas (fogo, água, curto-circuitos, quebras de electricidade, sobre-aquecimento...).

		Componentes usados na reparação, têm a garantia aplicável pelo fabricante para uma utilização “normal” do equipamento. A INFORZEN não se responsabilizará por quaisquer danos do cliente, resultantes do desgaste do material, roubo, perturbações atmosféricas e /ou eléctricas (fogo, água, curto-circuitos, quebras de electricidade, sobre-aquecimento...), relativamente ao material entregue para reparação. O cliente deve sempre que possível mencionar o mais explícito a avaria, pois será possível que o equipamento seja alvo de vários problemas. 

		O prazo de levantamento dos equipamentos: 15 dias após a comunicação verbal ou escrita (em pessoa, telefone, carta ou mensagem de texto) de que o respectivo equipamento está reparado. Caso contrário o material considera-se abandonado nos termos do artº 1267/1a do Código Civil, pelo que a nossa empresa deixa de ser responsável pela integridade do equipamento. A partir do momento em que este se considere abandonado o titular fica obrigado a pagar a titulo de cláusula penal a importância de 2,50€ (dois euros e cinquenta) por dia de atraso no levantamento. Passados 3 anos da data deste documento, e ao abrigo do artº 1299 do Código Civil, o material tornar-se-á propriedade desta empresa a título de usucapião. 

		Em caso de dívida, gozamos do direito de reter todo o material existente nas nossas instalações até que esta seja liquidada. O levantamento só será autorizado mediante o pagamento completo relativo ao trabalho efectuado. Caso seja verificado que o equipamento apresentado como avariado para reparação esteja a funcionar, será aplicada uma Taxa de Manuseamento (20,00€).A Garantia não se aplica em caso de mau uso ou desgaste de equipamento e componentes, erros de sistema operativo e/ou virus/spyware/malware.

		',0,'C');
	
	//Descrição da Assistência
	$pdf->SetFont('DejaVu','',12);
	$pdf->Cell(0,20,'Descrição da Assistência:',0,0,'L');
	$pdf->setFont('DejaVu','',9);
	$pdf->Cell(0,20,$descricao_a,0,1,'R'); 
	 
	//Descrição do Equipamento
	$pdf->SetFont('Dejavu','',12);
	$pdf->Cell(0,20,"Descrição do Equipamento:",0,0,'L');
	$pdf->setFont('Dejavu','',9);
	$pdf->Cell(0,20,$descricao_e,0,1,'R');
	 
	$pdf->Output("arquivo.pdf","I");

?>

