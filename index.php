<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Meta</title>    
    <meta name="description" content="Check Website's Meta tags">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    
        <!-- Header Section -->
        <div class="header">
            <div class="header-top">
                <h1>Check Meta</h1>
                <p>Easily Check Website Meta tags</p>
            </div>
            <div class="header-bottom search-container">
                <form method="get">
                    <input type="text" name="website_url" placeholder="Enter website address" value="<?= !empty($_GET['website_url'])? $_GET['website_url']: ''; ?>">
                    <button type="submit">Check Meta</button>
                </form>
            </div>
        </div>

        <!-- Content Section -->
        <div class="content-wrapper">

            <?php 
                if(file_exists(__DIR__."/process/process.php") && !empty($_GET['website_url'])):
                    include_once __DIR__."/process/process.php";                
            ?>         

                <!-- Website Address -->
                <div class="section">
                    <div class="section-head">
                        <h2>Website Address</h2>
                        <p>The address people will type in to get to your website.</p>
                    </div>
                    <div class="section-content">
                        <h3><?= !empty($data['url'])? strtolower($data['url']): $_GET['website_url']; ?></h3>
                    </div>
                </div>
            
                <?php
                    if(!isset($data['error'])):
                ?>
                        <!-- Social Section -->
                        <?php if( !empty($data['og_image']) || !empty($data['og_title']) || !empty($data['og_description']) || !empty($data['seo_title']) || !empty($data['meta_description'])  ): ?>
                            <div class="section">
                                <div class="section-head">
                                    <h2>Social Card Preview</h2>
                                    <p>This is how your website could look like when someone shares it.</p>
                                </div>
                                <div class="section-content social-card-preview">
                                    <?php if(!empty($data['og_image'])): ?>
                                        <div class="social-card-image">
                                            <img src="<?= $data['og_image']; ?>">
                                        </div>
                                    <?php endif; ?>

                                    <div class="social-card-content">
                                        <h3 class="social-card-title"><?= (!empty($data['og_title']))? $data['og_title']: $data['seo_title']; ?></h3>
                                        <p class="social-card-description"><?= (!empty($data['og_description']))? $data['og_description']: $data['meta_description']; ?></p>
                                        <p class="social-card-url"><?= (!empty($data['og_url']))? $data['og_url']: strtolower($_GET['website_url']); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Google Preview -->
                        <?php if(!empty($data['seo_title'])): 
                                $title = (strlen($data['seo_title']) > 60)? (substr($data['seo_title'], 0, 59) . '...'): $data['seo_title'];
                                $title = (strlen($data['meta_description']) > 160)? (substr($data['meta_description'], 0, 159) . '...'): $data['meta_description'];
                        ?>
                            <div class="section google-serp-preview">
                                <div class="section-head">
                                    <h2>Google SERP Preview</h2>
                                    <p>This is how your website could look in Google.</p>
                                </div>
                                <div class="section-content">
                                    <p class="google-serp-preview-breadcrumb-link"><?= strtolower($data['url']); ?></p>
                                    <h3 class="google-serp-preview-title"><?= (strlen($data['seo_title']) > 60)? substr($data['seo_title'], 0, 60)."...": $data['seo_title']; ?></h3>
                                    <p class="google-serp-preview-description"><?= (strlen($data['meta_description']) > 160)? substr($data['meta_description'], 0, 160)."...": $data['meta_description']; ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- SEO/Meta Title -->
                        <div class="section">
                            <div class="section-head">
                                <h2>Title</h2>
                                <p>Defines the title of the page.</p>
                            </div>
                            <div class="section-content">
                                <h3><?= !empty($data['seo_title'])? $data['seo_title']: ''; ?></h3>
                            </div>
                        </div>

                        <!-- Meta Description -->
                        <div class="section">
                            <div class="section-head">
                                <h2>Description</h2>
                                <p>Define a description of your web page.</p>
                            </div>
                            <div class="section-content">
                                <h3><?= !empty($data['meta_description'])? $data['meta_description']: ''; ?></h3>
                            </div>
                        </div>

                        <!-- Social Image and Social Image Properties -->
                        <!-- Social Image -->
                        <div class="section og-image">
                            <div class="section-head">
                                <h2>Social Image</h2>
                                <p>Image displayed when sharing the website.</p>
                            </div>
                            <div class="section-content">
                                <h3><?= !empty($data['og_image'])? $data['og_image']: 'Not found!'; ?>
                                </h3>
                            </div>
                            <?php if(!empty($data['og_image'])): ?>
                                <img src="<?= $data['og_image']; ?>" alt="">
                            <?php endif; ?>
                        </div>

                        <!-- Image Properties -->
                        <div class="section og-image-properties"> 
                            <div class="section-head">
                                <h2>Social Image Properties</h2>
                                <p>Current and recommended properties.</p>
                            </div>                                       
                            <div class="section-content">                                
                                <?php 
                                    if(!empty($data['og_image'])){
                                        $dimensions = @getimagesize($data['og_image']);
                                        preg_match('/\/(.*)/', $dimensions['mime'], $type);
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

                        <!-- Raw Data -->
                        <div class="section raw-data">
                            <div class="section-head">
                                <h2>Raw Data</h2>
                                <p>Show the fetched and extracted data in array format.</p>
                            </div>
                            <div class="section-content">                                
                                <a href="rawdata.php?website_url=<?= $_GET['website_url']; ?>" target="_blank">
                                    <div class="content-head">Show Raw Data</div>
                                </a>
                            </div>                                    
                        </div>

                        <!-- Origianl Response -->
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
                                        <?= $data['original response']; ?>
                                    </pre>
                                </div>
                            </div>                                    
                        </div>

                <?php 
                    else:
                ?>
                        <!-- Error -->
                        <div class="section">
                            <div class="section-head">
                                <h2>Error</h2>
                            </div>
                            <div class="section-content">
                                <h3><?= $data['error']; ?></h3>
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

    <script>
        //Toggle Original Response section
        const link = document.querySelector(".original-response #show-original-response-link");
        const originalResponseContentBody = document.querySelector(".original-response .content-body");
        link.addEventListener('click', function(e){
            e.preventDefault();
            originalResponseContentBody.classList.toggle('show');            
        });
    </script>
</body>
</html>