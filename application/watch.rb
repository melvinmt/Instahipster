require 'stringio'
require 'rubygems'
require 'fssm'
require "fssm/backends/polling"

stderr, $stderr = $stderr, StringIO.new
FSSM::Backends.const_set("Default", FSSM::Backends::Polling)
$stderr = stderr

directory = File.dirname(__FILE__) + "/media/js/app"
FSSM.monitor(directory, '**/*') do
	update do |base, relative|
		puts "#{base}/#{relative}"
		exit!
	end
	delete do |base, relative|
		puts "#{base}/#{relative}"
		exit!
	end
	create do |base, relative|
		puts "#{base}/#{relative}"
		exit!
	end
end