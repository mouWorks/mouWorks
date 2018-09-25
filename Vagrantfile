Vagrant.configure("2") do |config|
    config.vm.box = "ubuntu/xenial64"
    config.vm.network "forwarded_port", guest: 80, host: 8080
    config.vm.synced_folder "LindyHopperTaipei", "/var/www/html/LindyHopperTaipei"
    config.vm.provider "virtualbox" do |vb|
      vb.memory = "1536"
    end

  config.vm.provision "setup", type: "shell", path: "vagrantScripts/setup.sh"
  config.vm.provision "apacheSetting", type: "shell", path: "vagrantScripts/apacheSetting.sh", run: "always"
  config.vm.provision "composer", type: "shell", path: "vagrantScripts/composer.sh"

end