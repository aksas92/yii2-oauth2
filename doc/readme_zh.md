### code grant 校验过程

- 1、判断是否有response_type参数并它的值等于code
- 2、判断是否是否有client_id参数，并检测它是否等于空
- 3、查表oauth_clients看是否有这个client_id，再查表oauth_client_grants验证当前client_id是否绑定有authorization_code的权限
- 4、如果带有redirect_uri参数，检测它通过查询表oauth_client_profile表当前client_id的redirect_uri和url中的是否是一致的
- 5、如果带有scope参数，查看oauth_scopes表中是否存在这个权限
- 6、处理state参数原样带回
- 7、显示登陆页面
- 8、登陆，授权
- 9、生成code，并记录在表oauth_auth_codes，同时在表oauth_auth_code_scopes绑定这个code所申请的权限
- 10、确认跳转回应用