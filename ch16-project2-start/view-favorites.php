<?php

include 'includes/art-config.inc.php';

try {
    
    // connect and retrieve data for filters    
    $artistDB = new ArtistDB($pdo);
    $artists = $artistDB->getAll();   
    
    $galleryDB = new GalleryDB($pdo);
    $galleries = $galleryDB->getAll(); 
    
    $shapeDB = new ShapeDB($pdo);
    $shapes = $shapeDB->getAll();    
    
    
    // now retrieve paintings ... either all or a subset
    $paintDB = new PaintingDB($pdo);
    
    // filter by artist?
    if (isset($_GET['artist']) && ! empty($_GET['artist'])) {
        $paintings = $paintDB->findByArtist($_GET['artist']);
        
        $artist = $artistDB->findById($_GET['artist']);
        $filter = 'Artist = ' . makeArtistName($artist['FirstName'],$artist['LastName']) ;
    }
    
    // filter by museum?
    if (isset($_GET['museum']) && ! empty($_GET['museum'])) {
        $paintings = $paintDB->findByGallery($_GET['museum']);
        
        $museum = $galleryDB->findById($_GET['museum']);
        $filter = 'Museum = ' . utf8_encode($museum['GalleryName']);
    }    
    
    // filter by shape?
    if (isset($_GET['shape']) && ! empty($_GET['shape'])) {
        $paintings = $paintDB->findByShape($_GET['shape']);
        
        $shape = $shapeDB->findById($_GET['shape']);
        $filter = 'Shape = ' . $shape['ShapeName'];
    }     
                                            
    if (! isset($paintings) || $paintings->rowCount() == 0) {
        $paintings = $paintDB->getAll();
        $filter = "All Paintings [Top 20]";
    }
    
        
}
catch (PDOException $e) {
   die( $e->getMessage() );
}

function outputOptions($data, $valueField, $dataField) {
  while ($single = $data->fetch()) { 
    echo '<option value=' . $single[$valueField] . '>';
    echo utf8_encode($single[$dataField]);
    echo '</option>'; 
  }       
}

function makeArtistName($first, $last) {
    return utf8_encode($first . ' ' . $last);
}

?>
<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset=utf-8>
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="css/semantic.js"></script>
        <script src="js/misc.js"></script>
    
    <link href="css/semantic.css" rel="stylesheet" >
    <link href="css/icon.css" rel="stylesheet" >
    <link href="css/styles.css" rel="stylesheet">
    
</head>
<body >
    
<?php include 'includes/art-header.inc.php'; ?>
    
<main class="ui segment doubling stackable grid container">
    

    <section class="wide column">
	<h1 class="ui header">Favorites</h1>
	<table class="ui definition very basic collapsing celled table">
		<thead>
			<tr>
				<th>Image</th>
				<th>Title</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php if(isset($_SESSION['paintid'])) {
			for($i = 0; $i < count($_SESSION['paintid']); $i++) {
				?> 
				<tr> 
					<td><a class="ui small image" href="single-painting.php?id=<?php echo $_SESSION['paintid'][$i]; ?>"><img src="images/art/works/square-medium/<?php echo $_SESSION['paintfile'][$i]; ?>.jpg"></a></td>
					<td> <a class="header" href="single-painting.php?id=<?php echo $_SESSION['paintid'][$i]; ?>"><?php echo utf8_encode($_SESSION['paintTitle'][$i]); ?></a></td>
					<td><a href="remove-favorites.php?paintingid=<?php echo $_SESSION['paintid'][$i]; ?>&delete=singleitem"class="ui right  icon button"> Remove </a> </td>
				</tr>
				<?php
			}
		} ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="3"><td><a href="remove-favorites.php?delete=removeall"class="ui labeled icon blue button"> <i class="trash icon"></i>Remove All Favorites </a> </td></td>
			</tr>
		</tfoot>
	</table>
	</section>  
    
</main>    
    

    
  <footer class="ui black inverted segment">
      <div class="ui container">footer for later</div>
  </footer>
</body>
</html>