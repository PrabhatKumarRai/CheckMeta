<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheckMeta</title>
    <meta name="description" content="Check Website Meta tags">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    
        <!-- Header Section -->
        <div class="header">
            <div class="header-top">
                <h1>CheckMeta</h1>
                <p>Easily Check Website Meta tags</p>
            </div>
            <div class="header-bottom search-container">
                <form action="includes/process.php" method="get">
                    <input type="text" name="website_url" placeholder="Enter website address" value="<?= !empty($_GET['website_url'])? $_GET['website_url']: ''; ?>">
                    <button type="submit">Check Meta</button>
                </form>
            </div>
        </div>

        <!-- Content Section -->
        <div class="content-wrapper">

            <?php 
                if(!empty($_GET['website_url'])):
                    
                    $data = [];
                    if(isset($_SESSION['data'])){
                        $data = $_SESSION['data'];                        
                    }
                    if(isset($_SESSION['newdata'])){
                        $data = $_SESSION['newdata'] + $data;
                    }
                    extract($data);
            ?>

                <!-- Website Address -->
                <div class="section">
                    <div class="section-head">
                        <h2>Website Address</h2>
                        <p>The address people will type in to get to your website.</p>
                    </div>
                    <div class="section-content">
                        <h3><?= !empty($url)? $url: $_GET['website_url']; ?></h3>
                    </div>
                </div>
            
                <?php
                    if(!isset($error)):
                ?>
                        <form action="includes/generatemeta.php?website_url=<?= $_GET['website_url']; ?>" method="post">

                            <!-- Social Section -->
                            <div class="section">
                                <?php
                                    $og_title = (!empty($og_title))? $og_title: $seo_title;
                                    $og_description = (!empty($og_description))? $og_description: $meta_description;
                                    $og_url = (!empty($og_url))? $og_url: strtolower($_GET['website_url'])
                                ?>
                                <div class="section-head">
                                    <h2>Social Card Preview</h2>
                                    <p>This is how your website could look like when someone shares it.</p>
                                </div>
                                <div class="section-content social-card-preview">
                                    <div class="social-card-image">
                                        <?php if(!empty($og_image)): ?>
                                            <img src="<?= $og_image; ?>">
                                        <?php endif; ?>
                                    </div>

                                    <div class="social-card-content">
                                        <h3 class="social-card-title"><?= $og_title; ?></h3>
                                        <p class="social-card-description"><?= $og_description; ?></p>
                                        <p class="social-card-url"><?= $og_url; ?></p>
                                        
                                        <input type="hidden" name="og_title" value="<?= $og_title; ?>">
                                        <input type="hidden" name="og_description" value="<?= $og_description; ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- Google Preview -->
                            <div class="section google-serp-preview">
                                <?php
                                    $title = (strlen($seo_title) > 60)? (substr($seo_title, 0, 59) . '...'): $seo_title;
                                    $description = (strlen($meta_description) > 160)? (substr($meta_description, 0, 159) . '...'): $meta_description;
                                ?>
                                <div class="section-head">
                                    <h2>Google SERP Preview</h2>
                                    <p>This is how your website could look in Google.</p>
                                </div>
                                <div class="section-content">
                                    <p class="google-serp-preview-breadcrumb-link"><?= $url; ?></p>
                                    <input type="hidden" name="url" value="<?= $url; ?>">
                                    <!-- SERPs Preview Title and Description with character limits -->
                                    <h3 class="google-serp-preview-title"><?= $title; ?></h3>
                                    <p class="google-serp-preview-description"><?= $description; ?></p>
                                    
                                    <!-- Without any character limits -->
                                    <input type="hidden" name="seo_title_old" value="<?= $seo_title; ?>">
                                    <input type="hidden" name="meta_description_old" value="<?= isset($meta_description)? $meta_description: ''; ?>">
                                </div>
                            </div>

                            <!-- SEO/Meta Title -->
                            <div class="section">
                                <div class="section-head">
                                    <h2>Title</h2>
                                    <p>Defines the title of the page.</p>
                                </div>
                                <div class="section-content form-element-container">
                                    <input type="text" name="seo_title" id="seo-title" placeholder="No title found" value="<?= $seo_title; ?>">
                                </div>
                            </div>

                            <!-- Meta Description -->
                            <div class="section">
                                <div class="section-head">
                                    <h2>Description</h2>
                                    <p>Define a description of your web page.</p>
                                </div>
                                <div class="section-content form-element-container">
                                    <input type="text" name="meta_description" id="meta-description" placeholder="No description found" value="<?= $meta_description; ?>">
                                </div>
                            </div>

                            <!-- Social Image -->
                            <div class="section og-image">
                                <div class="section-head">
                                    <h2>Social Image</h2>
                                    <p>Image displayed when sharing the website.</p>
                                </div>
                                <div class="section-content form-element-container">
                                    <input type="text" name="og_image" id="og-image" placeholder="No social image found" value="<?= $og_image; ?>">
                                </div>
                                <?php if(!empty($og_image)): ?>
                                    <img src="<?= $og_image; ?>" alt="">
                                <?php endif; ?>
                            </div>

                            <!-- Social Image Properties -->
                            <div class="section og-image-properties"> 
                                <div class="section-head">
                                    <h2>Social Image Properties</h2>
                                    <p>Current and recommended properties.</p>
                                </div>                                       
                                <div class="section-content">                                
                                    <?php 
                                        if(!empty($og_image)){
                                            $dimensions = @getimagesize($og_image);
                                            if(is_array($dimensions)){
                                                preg_match('/\/(.*)/', $dimensions['mime'], $type);   
                                            }
                                        }
                                    ?>
                                    <table>
                                        <tr style="border-bottom: 1px solid #000;">
                                            <th>Status</th>
                                            <th>Width</th>
                                            <th>Height</th>
                                            <th>Type</th>
                                        </tr>
                                        <tr>
                                            <td>Current</td>
                                            <td><?= !empty($dimensions[0])? $dimensions[0]."px": '--'; ?></td>
                                            <td><?= !empty($dimensions[1])? $dimensions[1]."px": '--'; ?></td>
                                            <td><?= !empty($type[1])? strtoupper($type[1]): '--'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Recommended</td>
                                            <td>1200px</td>
                                            <td>630px</td>
                                            <td>PNG or JPEG or GIF</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <!-- Generate Meta -->
                            <div class="section generate-meta-tags" id="generate-meta">
                                <div class="section-head">
                                    <h2>Generate Meta Tags</h2>
                                    <p>Generates code tags based on above data.</p>
                                </div>
                                <div class="section-content form-element-container">
                                    <button name="submit">Generate Meta Tags</button>
                                    <?php
                                        if(!empty($_SESSION['newdata'])){

                                            $meta_tags = <<<Meta
                                                <!-- HTML Meta Tags -->
                                                <title>$seo_title</title>
                                                <meta name="description" content="$meta_description">
                                        
                                                <!-- Facebook Meta Tags -->
                                                <meta property="og:url" content="$og_url">
                                                <meta property="og:type" content="website">
                                                <meta property="og:title" content="$og_title">
                                                <meta property="og:description" content="$og_description">
                                                <meta property="og:image" content="$og_image">
                                        
                                                <!-- Twitter Meta Tags -->
                                                <meta name="twitter:card" content="summary_large_image">
                                                <meta name="twitter:title" content="$og_title">
                                                <meta name="twitter:description" content="$og_description">
                                                <meta name="twitter:image" content="$og_image">
                                        
                                                <!-- Meta Tags Generated by CheckMeta -->

                                            Meta;

                                            echo "<pre>" . htmlentities($meta_tags) . "</pre>";
                                        }
                                        
                                    ?>
                                </div>                                    
                            </div>

                            <!-- Raw Data -->
                            <div class="section raw-data">
                                <div class="section-head">
                                    <h2>Raw Data</h2>
                                    <p>Show the fetched and extracted data in array format.</p>
                                </div>
                                <div class="section-content">                                
                                    <a href="rawdata.php?website_url=<?= $url; ?>" target="_blank">
                                        <div class="content-head">Show Raw Data</div>
                                    </a>
                                </div>                                    
                            </div>

                            <!-- Original Response -->
                            <div class="section original-response">
                                <div class="section-head">
                                    <h2>Original Response</h2>
                                    <p>Show the entire fetched response.</p>
                                </div>
                                <div class="section-content">
                                    <a href="" id="show-original-response-link">
                                        <div class="content-head">Toggle Response</div>
                                    </a>
                                    <div class="content-body">
                                        <pre>
                                            <?= $original_response; ?>
                                        </pre>
                                    </div>
                                </div>                                    
                            </div>
                        </form>
                <?php 
                    else:
                ?>
                        <!-- Error -->
                        <div class="section">
                            <div class="section-head">
                                <h2>Error</h2>
                            </div>
                            <div class="section-content">
                                <h3><?= $error; ?></h3>
                            </div>
                        </div>
                <?php
                    endif;
                ?>
            
            <?php 
                endif; 
            ?>

        </div>       

        <!-- Footer Section -->
        <div class="footer">
            <hr>
            <p>By Prabhat Rai</p>
            <hr>
        </div>

    </div>

    <script src="script.js"></script>
</body>
</html>