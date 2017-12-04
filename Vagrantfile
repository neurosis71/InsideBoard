# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|

  # We use debian 8 to reflect the servers configuration
  config.vm.box = "ubuntu/xenial64"
  config.vm.hostname = "InsideBoard"
  config.vm.post_up_message = ""

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  config.vm.network "forwarded_port", guest: 80, host: 8080, auto_correct: true
  config.vm.network "forwarded_port", guest: 27017, host: 65017, auto_correct: true

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  # config.vm.network "private_network", ip: "192.168.33.10"

  config.vm.synced_folder ".", "/vagrant", type: "virtualbox"

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  config.vm.provider "virtualbox" do |vb|
    # Display the VirtualBox GUI when booting the machine
    # vb.gui = true
  
    #virtual machine name
    vb.name = "InsideBoard"
    
    #gives an id to the VM and limit host CPU usage to 50%
    vb.customize ["modifyvm", :id, "--cpuexecutioncap", "50"]
  
    # Customize the amount of memory on the VM:
    vb.memory = "1024"
    
    # Limits host cpu usage 
    vb.cpus = 1
  end
  

  # Enable provisioning with a shell script. Additional provisioners such as
  # Puppet, Chef, Ansible, Salt, and Docker are also available. Please see the
  # documentation for more information about their specific syntax and use.
  config.vm.provision "shell", inline: <<-SHELL
  


  	 #prevents pre-configuring all packages with debconf before they are installed.
  	 sudo ex +"%s@DPkg@//DPkg" -cwq /etc/apt/apt.conf.d/70debconf
	 sudo dpkg-reconfigure debconf -f noninteractive -p critical
         export DEBIAN_FRONTEND=noninteractive
  	 


  	 echo "------ Distro update -------"
         sudo apt-get update > /dev/null
     


         echo "------- Configuring locales -------"
         export LANGUAGE=en_US.UTF-8
	 export LANG=en_US.UTF-8
	 export LC_ALL=en_US.UTF-8
	 locale-gen en_US.UTF-8
	 dpkg-reconfigure locales
     


         echo "------- Installing build essentials -------"
         sudo apt-get install python-software-properties build-essential vim nano curl -y > /dev/null
         echo "------- Build essentials done -------"
     


         echo "------- Installing apache -------"
         sudo apt-get install -y apache2 > /dev/null
  	 if ! [ -L /var/www ]; then
  	   rm -rf /var/www
  	   ln -fs /vagrant /var/www
	 fi
         sudo a2dissite 000-default.conf
	 cp /vagrant/VagrantProvisionning/Apache/insideboard.conf /etc/apache2/sites-available/insideboard.conf
	 ln -s /etc/apache2/sites-available/insideboard.conf /etc/apache2/sites-enabled/insideboard.conf
         sudo a2enmod rewrite
         sudo mkdir /var/log/apache2/insideboard
         sudo mv /etc/apache2/envvars /etc/apache2/envvars.back
         sudo cp /vagrant/VagrantProvisionning/Apache/envvars /etc/apache2/envvars
	 sudo /etc/init.d/apache2 restart
	 echo "------- Apache done -------"
	  

         echo "------- Installing MongoDB -------"
         sudo apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 0C49F3730359A14518585931BC711F9BA15703C6
         echo "deb http://repo.mongodb.org/apt/ubuntu xenial/mongodb-org/3.4 multiverse" | sudo tee /etc/apt/sources.list.d/mongodb-org-3.4.list
         sudo apt-get update > /dev/null
         sudo apt-get install -y mongodb-org > /dev/null
         sudo mv /etc/mongod.conf /etc/mongod.conf.back
         sudo cp /vagrant/VagrantProvisionning/MongoDB/mongod.conf /etc/mongod.conf
         sudo systemctl enable mongod.service
         sudo systemctl start mongod

         echo "------- MongoDB done -------"


	 echo "------- Installing PHP -------"
         sudo echo "deb http://packages.dotdeb.org jessie all" > /etc/apt/sources.list.d/dotdeb.list
         wget -O- https://www.dotdeb.org/dotdeb.gpg | apt-key add -
         sudo apt-get update > /dev/null
         sudo apt-get install -y php7.0 libapache2-mod-php7.0 php7.0-curl php7.0-json php7.0-mcrypt php7.0-mbstring php7.0-xml php7.0-mongodb > /dev/null
	 echo "------- PHP done -------"
	  




	echo "------- Installing PHPUnit -------"
	wget https://phar.phpunit.de/phpunit.phar > /dev/null
	chmod +x phpunit.phar
	sudo mv phpunit.phar /usr/local/bin/phpunit
	phpunit --version
	echo "------- PHPUnit done -------"
      
      
     echo "##### Provisionning done! Congrats! #####"
      
  SHELL
end
