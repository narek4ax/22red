<p align="center">
<img src="./screenshot.png" width="600" height="450" />
</p>

### 22Red Theme
 Based on Dirango internal wordpress starter theme kit.

### Requirements
_This workflow takes into account if you already have a Wordpress development environment in place.
If not then please refer to [Docker Wordpress Init](https://github.com/DirangoLLC/docker-wordpress-init) as your starting development environment_

- Make sure you have yarn installed [Yarn install](https://yarnpkg.com/lang/en/docs/install/)
- webpack will be installed/initiated per project basis instead of globally (to mitigate version incompatibility)

### Mac Setup

- Install homebrew (Package Manager for Mac): 

``/usr/bin/ruby -e "$(curl -fsSL
https://raw.githubusercontent.com/Homebrew/install/master/install)"``

- Install Yarn via brew: ``brew install yarn``

### Windows Setup

- Open a Powershell in administrator mode
- Install Chocolatey (Package Manager for Windows): ``Set-ExecutionPolicy Bypass
  -Scope Process -Force; iex ((New-Object
System.Net.WebClient).DownloadString('https://chocolatey.org/install.ps1'))``
- Install Yarn via Chocolatey ``choco install yarn``
- Install depenencies via Yarn ``yarn install``


### Usage
- Clone repository and name according to project.
- Change into project directory and run: ```yarn install``` (this will install
  all dependencies required for development workflow.
- Once all dependencies are downloading run: ```yarn dev``` (this will start webpack and compile js/scss and split chunks into a vendors.js file for plugins to a build for development workflow)
- Happy Hacking!

_Questions or concerns? diran@dirango.com_
