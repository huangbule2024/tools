#!/bin/bash
#author:hbl 日志统一输出 移动到saas-api saas-srv 同级目录下执行

projects=("saas-api" "saas-srv")

# 定义日志文件的合并输出文件
output_file="/var/log/hyperf.log"

basepath=`pwd`

command_str='tail -f '
# 遍历所有项目
for dir in "${projects[@]}"; do
    for item in "$dir"/*; do
        if [ -d "$item" ]; then
            # 检查日志文件是否存在
            if [ -f "$basepath/$item/runtime/logs/hyperf-$(date +%Y-%m-%d).log" ]; then
                command_str="$command_str $basepath/$item/runtime/logs/hyperf-$(date +%Y-%m-%d).log "
            else
                echo "$basepath/$item/runtime/logs/hyperf-$(date +%Y-%m-%d).log not found"
            fi
        fi
    done
done
command_str="$command_str | tee -a $output_file"
echo $command_str
sh -c "$command_str"
