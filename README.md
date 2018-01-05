#	项目介绍
##	项目描述简介
类似京东商城的B2C商城 (C2C B2B O2O P2P ERP进销存 CRM客户关系管理)
电商或电商类型的服务在目前来看依旧是非常常用，虽然纯电商的创业已经不太容易，但是各个公司都有变现的需要，所以在自身应用中嵌入电商功能是非常普遍的做法。
为了让大家掌握企业开发特点，以及解决问题的能力，我们开发一个电商项目，项目会涉及非常有代表性的功能。
为了让大家掌握公司协同开发要点，我们使用git管理代码。
在项目中会使用很多前面的知识，比如架构、维护等等。
##	主要功能模块
系统包括：
后台：品牌管理、商品分类管理、商品管理、订单管理、系统管理和会员管理六个功能模块。
前台：首页、商品展示、商品购买、订单管理、在线支付等。
##	开发环境和技术
开发环境	Window
开发工具	Phpstorm+PHP5.6+GIT+Apache
相关技术	Yii2.0+CDN+jQuery+sphinx
##	项目人员组成周期成本
###	人员组成
职位	人数	备注
项目经理和组长	1	一般小公司由项目经理负责管理，中大型公司项目由项目经理或组长负责管理
开发人员	2-3	
UI设计人员	0	
前端开发人员	1	专业前端不是必须的，所以前端开发和UI设计人员可以同一个人
测试人员	1	有些公司并未有专门的测试人员，测试人员可能由开发人员完成测试。

公司有测试部，测试部负责所有项目的测试。

项目测试由产品经理进行业务测试。

项目中如果有测试，一般都具有Bug管理工具。（介绍某一个款，每个公司Bug管理工具不一样）

#	系统功能模块
##	需求
品牌管理：*
商品分类管理：*
商品管理：-
账号管理：
权限管理：
菜单管理：
订单管理：

##	流程
自动登录流程
购物车流程
订单流程
##	设计要点（数据库和页面交互）
系统前后台设计：前台www.yiishop.com 后台admin.yiishop.com 对url地址美化
商品无限级分类设计：
购物车设计

##	要点难点及解决方案
难点在于需要掌握实际工作中，如何分析思考业务功能，如何在已有知识积累的前提下搜索并解决实际问题，抓大放小，融会贯通，尤其要排除畏难情绪。
#	品牌功能模块
##	需求
品牌管理功能涉及品牌的列表展示、品牌添加、修改、删除功能。
品牌需要保存缩略图和简介。
品牌删除使用逻辑删除。 
##	流程

##	设计要点（数据库和页面交互）
 
##	要点难点及解决方案
1.	删除使用逻辑删除,只改变status属性,不删除记录
2.	使用webuploader插件,提升用户体验
3.	使用composer下载和安装webuploader
4.	composer安装插件报错,解决办法:
composer global require "fxp/composer-asset-plugin:^1.3.0"
5.	文件上传采用先进的七牛云OSS对象存储
4.	文章分类管理
##	需求
文章分类的增删改查
##	流程
###	建立数据表
###	建立模型
###	建立控制器
###	建立视图

##	设计要点（数据库和页面交互）
##	要点难点及解决方案
#	文章管理
##	需求
1.	文章的增删改查
2.	要有分类
3.	文章详情需要分表
##	流程
##	设计要点
1.	文章详情采用分表技术

#商品模块
##需要的表
1. 商品分类表
2. goods表
3. goods_intro表
4. goods_gallery
5. 促销类型表promotion
6. 商品促销关系goods_promotion

##技术点
1. 分类表的增删改查，左值右值，树状结构列表页
2. 商品的增删改查，要有分类，
3. 商品详情采用分表技术

##	流程
###	建立数据表
###	建立模型
###	建立控制器
###	建立视图
#	管理员模块
##	需求
1.	管理员增删改查
2.	管理员登录和注销
3.	自动登录(基于cookie)
4.	促销管理(选做)
##	要点
1.	创建admin表(在user表基础上添加最后登录时间和最后登录ip)

# RBAC权限管理
## 	需求
  1.	权限的增删改查
  2.	角色的增删改查
  3.	角色和权限关联
  4.	用户和角色关联
  5.	菜单的增删改查
  6.	菜单和权限关联
##	设计要点
  1.	配置RBAC（在common配置authManager组件，执行rbac数据迁移）
  2.	根据authManager相应方法进行开发



```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
