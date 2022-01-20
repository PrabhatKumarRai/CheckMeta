# CheckMeta
Just by entering page's URL, check the meta tags on the page. Based on those meta tags, social media card and Google SERP preview are generated.

The application has a simple and user-friendly UI which make getting along real easy.

## Features
* Full Social Media card preview based on OpenGraph tags
* Google SERP preview
* Meta Title and Description preview
* Social/og:image preview
* View the original fetched response (source code).
* Generate meta tags.
* Update page data/previews when fetched data is modified.

## Changelog
### v1.3.0
* Option to Generate meta tags.
* Modify the fetched meta data and generate meta tags with updated data.
* Update social image preview if the social image is modified.
* Except social card preview, all the sections would be displayed as empty, if they are empty. Social card preview would not be shown if the meta tags and OG (OpenGraph) tags are missing
* Code optimization to make the application lighter and faster.
* Bug fixes and improvements.

### v1.2.0
* Added rawdata.php file that prints all the fetched and extracted data in array format. It can be used by other applications to fetch data.
* Added a Raw Data section above the Original Response to easily move to rawdata.php with currently fetched URL.
* Title and Description character limits implimented on Google SERP Preview.
* Support for websites with minified source code.
* Improved formatting of source code in Original Response section.
* Appearance modifications.
* Bug fixes and improvements.

### v1.1.0
* Options to view the original fetched response (source code).
* Appearance modifications.
* Bug fixes and improvements.

### v1.0.0
* Full Social Media card preview based on OpenGraph tags
* Google SERP preview
* Meta Title and Description
* Social/og:image preview