SELECT a.id_assistencia,
a.descricao_assistencia, 
a.descricao_equipamento, 
a.data_entrada, 
a.data_saida, 
e.estado, 
s.tipo_servico, 
p.nome_produto, 
i.quantidade, 
a.valor_total, 
c.nome as nome_cli, f.nome as nome_func
FROM assistencias as a
INNER JOIN usados_efetuados ue
    on a.id_assistencia = ue.id_assistencia
LEFT JOIN instalacao i
    on i.id_assistencia = a.id_assistencia
INNER JOIN servicos s
	on s.id_servico = ue.id_servico
LEFT JOIN produtos p
	on p.id_produto = i.id_produto
INNER JOIN estados e
	on e.id_estado = ue.id_estado
INNER JOIN clientes c
	on a.id_cliente = c.id_cliente
INNER JOIN funcionarios f
	on a.id_funcionario = f.id_funcionario

/*UNION*/

/*SELECT a.id_assistencia,
a.descricao_assistencia, 
a.descricao_equipamento, 
a.data_entrada, 
a.data_saida, 
e.estado, 
s.tipo_servico, 
#p.nome_produto, 
#i.quantidade, 
a.valor_total, 
c.nome as nome_cli, f.nome as nome_func
FROM assistencias as a, clientes as c, funcionarios as f, usados_efetuados as ue, servicos as s, estados as e, instalacao as i #, #produtos as p
WHERE a.id_cliente=c.id_cliente
AND a.id_funcionario=f.id_funcionario
AND ue.id_estado=e.id_estado
AND ue.id_servico=s.id_servico
AND ue.id_assistencia=a.id_assistencia
#AND a.id_assistencia=i.id_assistencia
#AND p.id_produto=i.id_produto
;*/

/*SELECT * FROM assistencias as a
	LEFT JOIN instalacao as i
		ON i.id_assistencia=a.id_assistencia;*/
