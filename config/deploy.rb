set :application, "yakimbi"
set :repository,  "git@github.com:danielsan80/php_dev_interview_assignment.git"
set :serverName, "sg111.servergrove.com" # The server's hostname

set :scm, :git
set :domain,      "yakimbi.danilosanchi.net"
set :deploy_to,   "/var/www/vhosts/danilosanchi.net/subdomains/yakimbi/httpdocs/"

set :deploy_via,      :rsync_with_remote_cache
set :user,       "danilosa"
ssh_options[:port] = 22123

set  :keep_releases,  3

set  :use_sudo,      false

set :copy_exclude, [".git", ".DS_Store", ".gitignore", ".gitmodules"]

set :shared_children, ["data", "vendor", "config"]
set :shared_files,    []


after "deploy:symlink" do

    run "rm -Rf #{release_path}/data"
    run "ln -nfs #{shared_path}/data #{release_path}/data"

    run "ln -nfs #{shared_path}/vendor #{release_path}/vendor"

    run "cd #{release_path} && ./composer.phar install"
end

server "yakimbi.danilosanchi.net", :app