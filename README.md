# Vagrant

 The best way to view this on localhost is to install `vagrant` and `VirtualBox` on your dev machine. After installation you need to point your local domain to `33.33.33.10` in your `hosts` file. After that, you `cd` to `/vagrant` and enter `vagrant up` in your console.Wait until it finishes and navigate to your local domain in your browser.

# Configuration

1.	Register your via.me applicaton at [http://via.me/developers/apps]
2.	Fill out your `client_id`, `client_secret` and `redirect_uri` in `application/config/viame-example.php`
3.	Rename `application/config/viame-example.php` to `application/config/viame.php`
4.	Go!